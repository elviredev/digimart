@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Update Role') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.roles.index') }}" class="btn btn-dark btn-3">
                <i class="ti ti-arrow-left me-2"></i>
                {{ __('Back') }}
              </a>
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="col-md-12">
                <x-admin.input-text name="role" label="Role Name" value="{{ $role->name }}" />
              </div>
              <hr>
              <div class="row">
                @foreach($permissions as $groupName => $permissionItems)
                  <div class="col-md-4">
                    <h3>{{ $groupName }}</h3>

                    @foreach($permissionItems as $permission)
                      <label class="form-check">
                        <input
                          @checked($role->hasPermissionTo($permission))
                          class="form-check-input" type="checkbox"
                          value="{{ $permission->name }}"
                          name="permissions[]"
                        >
                        <span class="form-check-label">{{ $permission->name }}</span>
                      </label>
                    @endforeach
                  </div>
                @endforeach
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <button type="submit" onclick="$('form').submit()" class="btn btn-primary">{{ __('Update') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection