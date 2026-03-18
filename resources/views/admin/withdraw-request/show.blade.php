@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Withdraw Details') }}</h3>
            <div class="card-actions">
              <x-admin.back-button :href="route('admin.withdraw-requests.index')" />
            </div>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table table-striped">
                    <tbody>
                      <tr>
                        <td>{{ __('Author') }}</td>
                        <td>
                          <div>{{ $withdrawRequest->author->name }}</div>
                          <div>{{ $withdrawRequest->author->email }}</div>
                        </td>
                      </tr>
                      <tr>
                        <td>{{ __('Current Balance') }}</td>
                        <td>{{ currencyPosition($withdrawRequest->author->balance_formatted) }}</td>
                      </tr>
                      <tr>
                        <td>{{ __('Withdraw Amount') }}</td>
                        <td>{{ currencyPosition($withdrawRequest->amount_formatted) }}</td>
                      </tr>
                      <tr>
                        <td>{{ __('Payment Method') }}</td>
                        <td>{{ $withdrawRequest->method }}</td>
                      </tr>
                      <tr>
                        <td>{{ __('Account Info') }}</td>
                        <td>{!! nl2br($withdrawRequest->account) !!}</td>
                      </tr>
                      <tr>
                        <td>{{ __('Status') }}</td>
                        <td>
                          @if ($withdrawRequest->status == 'pending')
                            <span class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                          @elseif ($withdrawRequest->status == 'paid')
                            <span class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                          @else
                            <span class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td>{{ __('Created At') }}</td>
                        <td>{{ formatDate($withdrawRequest->created_at) }}</td>
                      </tr>
                      @if($withdrawRequest->status == 'pending')
                        <tr>
                          <td>{{ __('Action') }}</td>
                          <td>
                            <form action="{{ route('admin.withdraw-requests-status.update', $withdrawRequest->id) }}" method="POST">
                              @csrf
                              @method('PUT')

                              <x-admin.input-select name="status" :label="__('Status')" >
                                <option @selected($withdrawRequest->status == 'pending') value="pending">
                                  {{ __('Pending') }}
                                </option>
                                <option @selected($withdrawRequest->status == 'paid') value="paid">
                                  {{ __('Paid') }}
                                </option>
                                <option @selected($withdrawRequest->status == 'rejected') value="rejected">
                                  {{ __('Rejected') }}
                                </option>
                              </x-admin.input-select>
                              <x-admin.submit-button :label="__('Update')" />
                            </form>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer text-end"></div>
        </div>
      </div>
    </div>
  </div>
@endsection