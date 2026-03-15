@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Transactions') }}</h5>
        <p>{{ __('Your transactions history.') }}</p>
      </div>

    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">{{ __('N°') }}</th>
          <th class="details">{{ __('Transaction ID') }}</th>
          <th class="p_date">{{ __('Method') }}</th>
          <th class="price">{{ __('Paid Amount') }}</th>
          <th class="price">{{ __('Status') }}</th>
        </tr>
        </thead>
        <tbody>
          @forelse ($transactions as $key => $transaction)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $transaction->payment_id }}</td>
              <td>{{ $transaction->payment_gateway }}</td>
              <td class="text-uppercase">{{ $transaction->paid_in_amount }} {{ $transaction->paid_in_currency_icon }}</td>
              <td><span class="badge bg-success text-bg-success">{{ $transaction->status }}</span></td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center">{{ __('No transactions found.') }}</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div>
      {{ $transactions->links() }}
    </div>
  </div>
@endsection

