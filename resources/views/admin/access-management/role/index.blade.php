@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('All Roles') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-3">
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
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Permissions') }}</th>
                    <th class="w-8"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($roles as $role)
                      <tr>
                        <td>{{ $role->name }}</td>
                        <td class="text-secondary">
                          @if($role->name == 'super admin')
                            <span class="badge bg-blue text-blue-fg">{{ __('All permissions') }}</span>
                          @else
                            {{ $role->permissions_count }}
                          @endif
                        </td>
                        <td class="text-end">
                          @if($role->name !== 'super admin')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-primary">
                              <i class="ti ti-edit"></i>
                            </a>
                            <a class="delete-item text-danger ms-2" href="{{ route('admin.roles.destroy', $role->id) }}">
                              <i class="ti ti-trash"></i>
                            </a>
                          @endif
                        </td>
                      </tr>
                    @empty
                      <td colspan="3" class="text-center">{{ __('No roles found') }}</td>
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