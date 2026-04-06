<?php

use App\Http\Controllers\Frontend\AuthorWithdrawController;
use App\Http\Controllers\Frontend\CartItemController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemCommentController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\ItemReviewController;
use App\Http\Controllers\Frontend\KycVerificationController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage Frontend
Route::get('/', [HomeController::class, 'index'])
  ->name('home');
Route::get('/products', [ProductController::class, 'index'])
  ->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])
  ->name('products.show');
Route::get('/highlighted-products', [HomeController::class, 'highlightedProducts'])
  ->name('highlighted.products');
Route::post('/newsletter', NewsletterController::class)
  ->name('newsletter.store');
Route::get('/contact', [ContactController::class, 'index'])
  ->name('contact');
Route::post('/contact', [ContactController::class, 'sendMail'])
  ->name('contact.send-mail');

Route::group(['middleware' => ['auth', 'verified']], function () {
  // Dashboard Frontend
  Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

  // Profile
  Route::get('profile', [ProfileController::class, 'index'])
    ->name('profile');
  Route::put('profile', [ProfileController::class, 'update'])
    ->name('profile.update');
  Route::put('password', [ProfileController::class, 'updatePassword'])
    ->name('password.update');

  // KYC
  Route::get('kyc', [KycVerificationController::class, 'index'])
    ->name('kyc.index')
    ->middleware('kyc');
  Route::post('kyc', [KycVerificationController::class, 'store'])
    ->name('kyc.store')
    ->middleware('kyc');

  // Cart Routes
  Route::get('cart', [CartItemController::class, 'index'])
    ->name('cart.index');
  Route::post('add-cart/{id}', [CartItemController::class, 'store'])
    ->name('cart.store');
  Route::delete('remove-cart/{id}', [CartItemController::class, 'destroy'])
    ->name('cart.destroy');
  /** checkout */
  Route::get('checkout', CheckoutController::class)
    ->name('checkout.index');

  /** Order Routes */
  Route::get('orders', [OrderController::class, 'index'])
    ->name('orders.index');
  Route::get('orders/{id}', [OrderController::class, 'show'])
    ->name('orders.show');
  Route::get('transactions', [OrderController::class, 'transactions'])
    ->name('transactions.index');
  Route::get('sales', [OrderController::class, 'sales'])
    ->name('sales.index');

  /** Item Comments Routes */
  Route::post('item/{id}/comment', [ItemCommentController::class, 'store'])
    ->name('item.comment.store');

  /** Item Reviews Routes */
  Route::post('item/{id}/review', [ItemReviewController::class, 'store'])
    ->name('item.review.store');

  /** Dashboard Reviews Routes */
  Route::get('reviews', [DashboardController::class, 'reviews'])
    ->name('reviews.index');

  /** Payment Routes */
  Route::get('order/completed', [PaymentController::class, 'completed'])
    ->name('order.completed');
  Route::get('order/canceled', [PaymentController::class, 'canceled'])
    ->name('order.canceled');

  /** PayPal Routes */
  Route::get('payment/paypal', [PaymentController::class, 'payWithPaypal'])
    ->name('payment.paypal');
  Route::get('payment/paypal/success', [PaymentController::class, 'paypalSuccess'])
    ->name('payment.paypal.success');
  Route::get('payment/paypal/cancel', [PaymentController::class, 'paypalCancel'])
    ->name('payment.paypal.cancel');

  /** Stripe Routes */
  Route::get('payment/stripe', [PaymentController::class, 'payWithStripe'])
    ->name('payment.stripe');
  Route::get('payment/stripe/success', [PaymentController::class, 'stripeSuccess'])
    ->name('payment.stripe.success');
  Route::get('payment/stripe/cancel', [PaymentController::class, 'stripeCancel'])
    ->name('payment.stripe.cancel');

});


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
  // Author Routes Group
  Route::group(['middleware' => 'is_author'], function () {
    Route::get('items', [ItemController::class, 'index'])->name('items.index');
    Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('item-uploads', [ItemController::class, 'itemUploads'])->name('items.uploads');
    Route::delete('item-destroy/{id}', [ItemController::class, 'itemDestroy'])->name('items.destroy');
    Route::post('item/store', [ItemController::class, 'storeItem'])->name('items.store');
    Route::get('item/{id}/edit', [ItemController::class, 'editItem'])->name('items.edit');
    Route::put('item/{id}/update', [ItemController::class, 'updateItem'])->name('items.update');
    Route::get('item/{id}/download', [ItemController::class, 'itemDownload'])->name('items.download');
    Route::get('item/{id}/changelog', [ItemController::class, 'itemChangelog'])->name('items.changelog');
    Route::post('item/{id}/changelog', [ItemController::class, 'itemChangelogStore'])->name('items.changelog.store');
    Route::get('item/{id}/history', [ItemController::class, 'itemHistory'])->name('items.history');
    Route::post('withdraw-info', [ProfileController::class, 'withdrawInfo'])->name('withdraw.info');
    Route::get('withdraws', [AuthorWithdrawController::class, 'index'])->name('withdraws.index');
    Route::get('withdraws/create', [AuthorWithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('withdraws', [AuthorWithdrawController::class, 'store'])->name('withdraw.store');
  });
});

require __DIR__.'/auth.php';
