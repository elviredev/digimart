@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Withdraw List') }}</h5>
        <p>{{ __('All withdraws history.') }}</p>
      </div>
      <div>
        <a href="{{ route('user.withdraw.create') }}" class="btn btn-primary">{{ __('Create a Request') }}</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">{{ __('N°') }}</th>
          <th class="price">{{ __('Amount') }}</th>
          <th class="sn">{{ __('Status') }}</th>
          <th class="sn">{{ __('Date') }}</th>
        </tr>
        </thead>
        <tbody>
          @forelse(user()->withdraws as $withdraw)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ currencyPosition($withdraw->amount_formatted) }}</td>
              <td>
                @if($withdraw->status == 'pending')
                  <span class="badge bg-warning text-white d-inline py-2">{{ $withdraw->status }}</span>
                @elseif($withdraw->status == 'paid')
                  <span class="badge bg-success text-white d-inline py-2">{{ $withdraw->status }}</span>
                @else
                  <span class="badge bg-danger text-white d-inline py-2">{{ $withdraw->status }}</span>
                @endif
              </td>
              <td class="text-start">{{ formatDate($withdraw->created_at) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No withdraws found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div>
{{--      {{ $sales->links() }}--}}
    </div>

  </div>
@endsection

