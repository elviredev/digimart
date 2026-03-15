@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Author Sales') }}</h5>
        <p>{{ __('All sales history.') }}</p>
      </div>

    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">{{ __('N°') }}</th>
          <th class="details">{{ __('Details') }}</th>
          <th class="p_date">{{ __('Earning') }}</th>
          <th class="price">{{ __('Platform Charge') }}</th>
          <th class="price">{{ __('Amount') }}</th>
          <th class="p_date">{{ __('Date') }}</th>
        </tr>
        </thead>
        <tbody>
          @forelse ($sales as $key => $sale)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="text-start">
                <div>
                  <h6>
                    <a href="{{ route('products.show', $sale->item->slug) }}" target="_blank">{{ $sale->item->name }}</a>
                  </h6>
                </div>
                <div>
                  <span>{{ $sale->item->category->name }} / {{ $sale->item->subCategory->name }}</span>
                </div>
              </td>
              <td><b class="text-success">+{{ config('settings.currency_icon') }}{{ $sale->author_earning_formatted }}</b></td>
              <td><b class="text-danger">-{{ config('settings.currency_icon') }}{{ $sale->platform_earning_formatted }}</b></td>
              <td><b>{{ config('settings.currency_icon') }}{{ $sale->amount_formatted }}</b></td>
              <td class="text-start">{{ formatDate($sale->created_at) }}</td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center">{{ __('No sales found.') }}</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div>
      {{ $sales->links() }}
    </div>
  </div>
@endsection

