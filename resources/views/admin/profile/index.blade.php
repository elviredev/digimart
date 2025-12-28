@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <form class="card" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="card-body">
            <h3 class="card-title">{{ __('Edit Profile') }}</h3>
            <div class="row row-cards">
              <div class="col-md-12">
                <x-admin.image-preview :src="asset(auth('admin')->user()->avatar)" height="128" width="128" />
              </div>
              <div class="col-md-12">
                <x-admin.input-text type="file" name="avatar" :label="__('Avatar')" />
              </div>
              <div class="col-md-6">
                <x-admin.input-text name="name" :label="__('Name')" :value="auth('admin')->user()->name" />
              </div>
              <div class="col-md-6">
                <x-admin.input-text name="email" :label="__('Email')" :value="auth('admin')->user()->email" />
              </div>
            </div>
          </div>
          <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
          </div>
        </form>

        <form class="card mt-3" action="{{ route('admin.password.update') }}" method="POST" >
          @csrf
          @method('PUT')

          <div class="card-body">
            <h3 class="card-title">{{ __('Update Password') }}</h3>
            <div class="row row-cards">
              <div class="col-md-4">
                <x-admin.input-text name="current_password" type="password" :label="__('Current Password')" :placeholder="__('Your current password')" />
              </div>
              <div class="col-md-4">
                <x-admin.input-text name="password" type="password" :label="__('New Password')" :placeholder="__('Your new password')" />
              </div>
              <div class="col-md-4">
                <x-admin.input-text name="password_confirmation" type="password" :label="__('Confirm Password')" :placeholder="__('Confirm your new password')" />
              </div>
            </div>
          </div>
          <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection