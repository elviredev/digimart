@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('KYC Requests') }}</h3>

          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-vcenter card-table table-striped">
                <thead>
                <tr>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Document Type') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th class="w-8"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($kycRequests as $request)
                  <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>
                      {{ $request->user->email }}
                    </td>
                    <td class="">
                      {{ ucfirst($request->document_type) }}
                    </td>
                    <td>
                      @switch($request->status)
                        @case('pending')
                          <span class="badge bg-orange text-orange-fg">{{ $request->status }}</span>
                          @break
                        @case('approved')
                          <span class="badge bg-green text-orange-fg">{{ $request->status }}</span>
                          @break
                        @default
                          <span class="badge bg-red text-orange-fg">{{ $request->status }}</span>
                      @endswitch
                    </td>
                    <td>
                      <a href="{{ route('admin.kyc.show', $request->id) }}" class="text-primary">
                        <i class="ti ti-eye"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <td colspan="3" class="text-center">{{ __('No roles found') }}</td>
                @endforelse

                </tbody>
              </table>
            </div>
          </div>

          <div class="card-footer text-end">
            {{ $kycRequests->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection