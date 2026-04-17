@extends('frontend.dashboard.layouts.master')

@section('content')
  @if(user()->kyc_status == 0 && user()->kyc->first()?->status == 'pending')
    <!-- Alert Status KYC -->
    <div class="alert alert-important alert-warning alert-dismissible" role="alert">
      <div class="d-flex">
        <div class="me-2">
          <i class="ti ti-alert-square-rounded"></i>
        </div>

        <div>
          {{ __('Your KYC Request is Pending. You will get Notify when it will be approved.') }}
        </div>
      </div>
      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
  @endif

  <!-- welcome balance Content Start -->
  <div class="welcome-balance mt-2 mb-40 flx-between gap-2">
    <div class="welcome-balance__left">
      <h4 class="welcome-balance__title mb-0">{{ __(' Welcome back!') }} {{ user()->name }}</h4>
    </div>
  </div>
  <!-- welcome balance Content End -->

  <div class="dashboard-body__item-wrapper">

    <!-- dashboard body Item Start -->
    <div class="dashboard-body__item">
      <div class="row gy-4">
        <div class="col-xl-3 col-sm-6">
          <div class="dashboard-widget green">
            <span class="dashboard-widget__icon">
              <i class="ti ti-basket-check"></i>
            </span>
            <div class="dashboard-widget__content flx-between gap-1 align-items-end">
              <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ $purchaseCount }}</h4>
                <span class="dashboard-widget__text font-14">{{ __('Total Purchase') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="dashboard-widget orange">
            <span class="dashboard-widget__icon">
              <i class="ti ti-star"></i>
            </span>
            <div class="dashboard-widget__content flx-between gap-1 align-items-end">
              <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ $reviewCount }}</h4>
                <span class="dashboard-widget__text font-14">{{ __('Total Reviews') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="dashboard-widget blue">
            <span class="dashboard-widget__icon">
              <i class="ti ti-cash-register"></i>
            </span>
            <div class="dashboard-widget__content flx-between gap-1 align-items-end">
              <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition($totalSpent) }}</h4>
                <span class="dashboard-widget__text font-14">{{ __('Total Spent') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="dashboard-widget red">
            <span class="dashboard-widget__icon">
              <i class="ti ti-transaction-dollar"></i>
            </span>
            <div class="dashboard-widget__content flx-between gap-1 align-items-end">
              <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ $totalTransaction }}</h4>
                <span class="dashboard-widget__text font-14">{{ __('Total Transactions') }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- dashboard body Item End -->
  </div>
@endsection