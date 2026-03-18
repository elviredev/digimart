@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('All Withdraw Requests') }}</h3>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Author</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th class="w-8"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($withdrawRequests as $withdrawRequest)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <div>{{ $withdrawRequest->author->name }}</div>
                        <div>{{ $withdrawRequest->author->email }}</div>
                      </td>
                      <td>{{ currencyPosition($withdrawRequest->amount_formatted) }}</td>
                      <td>
                        @if($withdrawRequest->status == 'pending')
                          <span class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                        @elseif($withdrawRequest->status == 'paid')
                          <span class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                        @else
                          <span class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                        @endif
                      </td>
                      <td>{{ formatDate($withdrawRequest->created_at) }}</td>
                      <td>
                        <a href="{{ route('admin.withdraw-requests.show', $withdrawRequest->id) }}">
                          <i class="ti ti-eye"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">{{ __('No withdraw requests found.') }}</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card-footer text-end"></div>
        </div>
      </div>
    </div>
  </div>
@endsection