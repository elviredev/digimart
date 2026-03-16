@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('All Witdrawal Methods') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.withdrawal-methods.create') }}" class="btn btn-primary btn-3">
                <i class="ti ti-plus me-1"></i>
                {{ __('Add new') }}
              </a>
            </div>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>{{ __('Name') }}</th>
                      <th>{{ __('Minimum Amount') }}</th>
                      <th>{{ __('Maximum Amount') }}</th>
                      <th>{{ __('Status') }}</th>
                      <th class="w-8"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($methods as $method)
                    <tr>
                      <td>{{ $method->name }}</td>
                      <td>{{ currencyPosition($method->minimum_amount) }}</td>
                      <td>{{ currencyPosition($method->maximum_amount) }}</td>
                      <td>
                        @if($method->status == 1)
                          <span class="badge bg-green text-green-fg">{{ __('Active') }}</span>
                        @else
                          <span class="badge bg-red text-red-fg">{{ __('Inactive') }}</span>
                        @endif
                      </td>

                      <td class="text-end">
                        <a href="{{ route('admin.withdrawal-methods.edit', $method->id) }}" class="text-primary">
                          <i class="ti ti-edit"></i>
                        </a>
                        <a class="delete-item text-danger ms-2" href="{{ route('admin.withdrawal-methods.destroy', $method->id) }}">
                          <i class="ti ti-trash"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">{{ __('No withdrawal methods found.') }}</td>
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