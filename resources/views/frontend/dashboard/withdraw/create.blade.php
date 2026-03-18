@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Create Withdraw Request') }}</h5>
      </div>
      <div>
        <a href="{{ route('user.withdraws.index') }}" class="btn btn-secondary">{{ __('Go Back') }}</a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xl-3 col-sm-6">
        <div class="dashboard-widget red">
          <span class="dashboard-widget__icon">
            <i class="ti ti-scale"></i>
          </span>
          <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
              <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->balance) }}</h4>
              <span class="dashboard-widget__text font-14">{{ __('Current Balance') }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="dashboard-widget red">
          <span class="dashboard-widget__icon">
            <i class="ti ti-trending-up"></i>
          </span>
          <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
              <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->withdraws()->whereStatus('pending')->sum('amount')) }}</h4>
              <span class="dashboard-widget__text font-14">{{ __('Pending Withdraw') }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="dashboard-widget red">
          <span class="dashboard-widget__icon">
            <i class="ti ti-pig-money"></i>
          </span>
          <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
              <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->withdraws()->whereStatus('paid')->sum('amount')) }}</h4>
              <span class="dashboard-widget__text font-14">{{ __('Total Withdraw') }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="dashboard-widget red">
          <span class="dashboard-widget__icon">
            <i class="ti ti-currency-dollar"></i>
          </span>
          <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
              <h4 class="dashboard-widget__number mb-1 mt-3">
                {{ currencyPosition(user()->authorSales()->sum('author_earning')) }}
              </h4>
              <span class="dashboard-widget__text font-14">{{ __('Total Earnings') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <td>
              {{ __('Payment Method') }}
            </td>
            <td class="text-start">
              {{ user()->authorWithdrawInfo?->withdrawGateway->name }}
            </td>
          </tr>
          <tr>
            <td>
              {{ __('Account Info') }}
            </td>
            <td class="text-start">
              {!! nl2br(user()->authorWithdrawInfo?->information) !!}
            </td>
          </tr>
          <tr>
            <td>
              {{ __('Minimum Withdraw Amount') }}
            </td>
            <td class="text-start">
              {{ currencyPosition(user()->authorWithdrawInfo?->withdrawGateway->minimum_amount_formatted) }}
            </td>
          </tr>
          <tr>
            <td>
              {{ __('Maximum Withdraw Amount') }}
            </td>
            <td class="text-start">
              {{ currencyPosition(user()->authorWithdrawInfo?->withdrawGateway->maximum_amount_formatted) }}
            </td>
          </tr>
        </table>
      </div>
    </div>

    <hr>
    <form action="{{ route('user.withdraw.store') }}" method="POST">
      @csrf

      <x-frontend.input-text name="amount" :label="__('Amount')" :required="true" />

      <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
    </form>
  </div>
@endsection

