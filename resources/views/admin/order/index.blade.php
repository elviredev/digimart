@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('All Orders') }}</h3>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Buyer</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($orders as $order)
                    <tr>
                      <td>#{{ $order->code }}</td>
                      <td>{{ $order->user->name }}</td>
                      <td class="text-green fw-semibold text-uppercase">{{ $order->transaction->paid_in_amount }} {{ $order->transaction->paid_in_currency_icon }}</td>
                      <td>
                        <span class="badge bg-green text-white">{{ $order->status }}</span>
                      </td>
                      <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">
                          <i class="ti ti-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">No orders found</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card-footer text-end">

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection