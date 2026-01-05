@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Role Users') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary btn-3">
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
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th class="w-8"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($admins as $admin)
                      <tr>
                        <td>{{ $admin->name }}</td>
                        <td class="text-secondary">{{ $admin->email }}</td>
                        <td>
                         @foreach ($admin->getRoleNames() as $role)
                           <span class="badge bg-blue text-blue-fg">{{ $role }}</span>
                         @endforeach
                        </td>

                        <td class="text-end">
                          <a href="{{ route('admin.role-users.edit', $admin->id) }}" class="text-primary">
                            <i class="ti ti-edit"></i>
                          </a>
                          <a href="{{ route('admin.role-users.destroy', $admin->id) }}" class="delete-item text-danger ms-2" >
                            <i class="ti ti-trash"></i>
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
          </div>

          <div class="card-footer text-end">

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection