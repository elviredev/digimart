<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
  public function completed(): View
  {
    return view('frontend.pages.order-completed');
  }

  public function canceled(): View
  {
    return view('frontend.pages.order-canceled');
  }

  /** PayPal Methods */
  
  public function setPaypalConfig(): array
  {
    return [
      'mode'    => config('settings.paypal_mode'),
      'sandbox' => [
        'client_id'         => config('settings.paypal_client_id'),
        'client_secret'     => config('settings.paypal_secret_key'),
        'app_id'            => 'APP-80W284485P519543T',
      ],
      'live' => [
        'client_id'         => config('settings.paypal_client_id'),
        'client_secret'     => config('settings.paypal_secret_key'),
        'app_id'            => config('settings.paypal_app_id'),
      ],

      'payment_action' => 'Sale',
      'currency'       => config('settings.default_currency'),
      'notify_url'     => '',
      'locale'         => 'en_US',
      'validate_ssl'   => true,
    ];
  }

  public function payWithPaypal(): RedirectResponse
  {
    $payableAmount = getCartTotal();

    $config = $this->setPaypalConfig();
    $provider = new PayPalClient($config);
    $provider->getAccessToken();

    $response = $provider->createOrder([
      'intent' => 'CAPTURE',
      'application_context' => [
        'return_url' => route('payment.paypal.success'),
        'cancel_url' => route('payment.paypal.cancel'),
      ],
      'purchase_units' => [
        [
          'amount' => [
            'currency_code' => config('settings.default_currency'),
            'value' => $payableAmount,
          ]
        ]
      ]
    ]);

    if (isset($response['id']) && $response['status'] == 'CREATED') {
      foreach ($response['links'] as $link) {
        if ($link['rel'] == 'approve') {
          return redirect()->away($link['href']);
        }
      }
    }
  }

  public function paypalSuccess(Request $request): RedirectResponse
  {
    $config = $this->setPaypalConfig();
    $provider = new PayPalClient($config);
    $provider->getAccessToken();

    $response = $provider->capturePaymentOrder($request->token);

    if (isset($response['status']) && $response['status'] == 'COMPLETED') {
      $order = $response['purchase_units'][0]['payments']['captures'][0];

      OrderService::storeOrder(
        paymentId: $order['id'],
        paidInAmount: $order['amount']['value'],
        paidInCurrencyIcon: $order['amount']['currency_code'],
        exchangeRate: 1,
        paymentGateway: 'PayPal',
      );

      return redirect()->route('order.completed');
    }
  }

  public function paypalCancel(Request $request): RedirectResponse
  {
    return redirect()->route('order.canceled');
  }
  
  /** Stripe Methods */

  public function payWithStripe(): RedirectResponse
  {
    $payableAmount = (getCartTotal() * 100);

    Stripe::setApiKey(config('settings.stripe_secret_key'));

    $response = StripeSession::create([
      'line_items' => [
        [
          'price_data' => [
            'currency' => config('settings.default_currency'),
            'product_data' => [
              'name' => 'Product Purchase'
            ],
            'unit_amount' => $payableAmount
          ],
          'quantity' => 1
        ],
      ],
      'mode' => 'payment',
      'success_url' => route('payment.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => route('payment.stripe.cancel'),
    ]);

    return redirect()->away($response->url);
  }

  public function stripeSuccess(Request $request): RedirectResponse
  {
    abort_if(empty($request->session_id), 404);

    Stripe::setApiKey(config('settings.stripe_secret_key'));

    $response = StripeSession::retrieve($request->session_id);

    if($response->payment_status == 'paid') {
      OrderService::storeOrder(
        paymentId: $response->payment_intent,
        paidInAmount: $response->amount_total / 100,
        paidInCurrencyIcon: $response->currency,
        exchangeRate: 1,
        paymentGateway: 'Stripe',
      );

      return redirect()->route('order.completed');
    }

  }

  public function stripeCancel(): RedirectResponse
  {
    return redirect()->route('order.canceled');
  }
}
