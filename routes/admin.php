<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BannerSectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CounterSectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedAuthorSectionController;
use App\Http\Controllers\Admin\FeaturedCategoryController;
use App\Http\Controllers\Admin\FooterSectionController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HighlightedProductController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\KYCSettingController;
use App\Http\Controllers\Admin\MonthlyPickedProductsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->as('admin.')
  ->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
      ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
      ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
      ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
      ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
      ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->as('admin.')
  ->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
      ->name('logout');

    /** Dashboard Admin */
    Route::get('dashboard', [DashboardController::class, 'index'])
      ->name('dashboard');

    /** Profile Routes */
    Route::get('profile', [ProfileController::class, 'index'])
      ->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])
      ->name('profile.update');
    Route::put('password', [ProfileController::class, 'updatePassword'])
      ->name('password.update');

    /** Role & Permissions Management Routes */
    Route::resource('roles', RoleController::class);

    /** Role User Routes */
    Route::resource('role-users', RoleUserController::class);

    /** KYC Routes */
    Route::get('kyc-settings', [KYCSettingController::class, 'index'])
      ->name('kyc-settings.index');
    Route::put('kyc-settings', [KYCSettingController::class, 'update'])
      ->name('kyc-settings.update');
    Route::get('kyc-download-document/{kyc}/{attachment_id}', [KycController::class, 'downloadDocument'])
      ->name('kyc.download-document');
    Route::put('kyc-status/{kyc}', [KycController::class, 'updateStatus'])
      ->name('kyc.status');
    Route::resource('kyc', KycController::class);

    /** Categories Routes */
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);

    /** Item Review Routes */
    Route::get('item-reviews/pending', [ItemReviewController::class, 'pendingIndex'])
      ->name('item-reviews.pending.index');
    Route::get('item-reviews/approved', [ItemReviewController::class, 'approvedIndex'])
      ->name('item-reviews.approved.index');
    Route::get('item-reviews/hard-rejected', [ItemReviewController::class, 'hardRejectedIndex'])
      ->name('item-reviews.hard-rejected.index');
    Route::get('item-reviews/soft-rejected', [ItemReviewController::class, 'softRejectedIndex'])
      ->name('item-reviews.soft-rejected.index');
    Route::get('item-reviews/resubmitted', [ItemReviewController::class, 'resubmittedIndex'])
      ->name('item-reviews.resubmitted.index');
    Route::get('item-reviews/{id}/show', [ItemReviewController::class, 'show'])
      ->name('item-reviews.show');
    Route::post('item-reviews/{id}/status', [ItemReviewController::class, 'updateStatus'])
      ->name('item-reviews.status');
    Route::get('item/{id}/download', [ItemReviewController::class, 'itemDownload'])
      ->name('item.download');

    /** Order Routes */
    Route::get('orders', [OrderController::class, 'index'])
      ->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])
      ->name('orders.show');

    /** Withdrawal Methods Routes */
    Route::resource('withdrawal-methods', WithdrawMethodController::class);

    /** Withdrawal Requests Routes */
    Route::get('withdraw-requests', [WithdrawRequestController::class, 'index'])
      ->name('withdraw-requests.index');
    Route::get('withdraw-requests/{id}/show', [WithdrawRequestController::class, 'show'])
      ->name('withdraw-requests.show');
    Route::put('withdraw-requests/{id}/status', [WithdrawRequestController::class, 'updateStatus'])
      ->name('withdraw-requests-status.update');

    /** Sections Routes */
    Route::get('ajax/product-search', [HeroSectionController::class, 'productSearch'])
      ->name('ajax.product-search');
    Route::resource('hero-section', HeroSectionController::class);
    Route::resource('featured-categories-section', FeaturedCategoryController::class);
    Route::resource('highlighted-products-section', HighlightedProductController::class);
    Route::resource('monthly-picked-products-section', MonthlyPickedProductsController::class);
    Route::resource('featured-author-section', FeaturedAuthorSectionController::class);
    Route::resource('counter-section', CounterSectionController::class);
    Route::resource('footer-section', FooterSectionController::class);

    Route::put('banner-one-update', [BannerSectionController::class, 'updateBannerOne'])
      ->name('banner-one.update');
    Route::put('banner-two-update', [BannerSectionController::class, 'updateBannerTwo'])
      ->name('banner-two.update');
    Route::resource('banner-section', BannerSectionController::class);

    /** Social Links Routes */
    Route::resource('social-links', SocialLinkController::class);

    /** Subscribers Routes */
    Route::get('subscribers', [SubscribersController::class, 'index'])
      ->name('subscribers.index');
    Route::delete('subscribers/{subscriber}', [SubscribersController::class, 'destroy'])
      ->name('subscribers.destroy');
    Route::post('send-newsletter', [SubscribersController::class, 'sendNewsletter'])
      ->name('send-newsletter');

    /** Payment Settings Routes */
    Route::get('payment-settings', [PaymentSettingController::class, 'index'])
      ->name('payment-settings.index');

    Route::put('paypal-settings', [PaymentSettingController::class, 'updatePaypalSettings'])
      ->name('paypal-settings.update');

    Route::get('stripe-settings', [PaymentSettingController::class, 'stripeSettings'])
      ->name('stripe-settings.index');
    Route::put('stripe-settings', [PaymentSettingController::class, 'updateStripeSettings'])
      ->name('stripe-settings.update');

    /** Settings Routes */
    Route::get('settings', [SettingController::class, 'index'])
      ->name('settings.index');
    Route::put('general-settings', [SettingController::class, 'updateGeneralSettings'])
      ->name('settings.general.update');
    Route::get('commission-settings', [SettingController::class, 'commissionSettings'])
      ->name('settings.commission.index');
    Route::put('commission-settings', [SettingController::class, 'updateCommissionSettings'])
      ->name('settings.commission.update');
  });
