@extends('admin.setting.master')

@section('setting_content')
  <div class="col-12 col-md-9 d-flex flex-column">
    <div class="card-body">
      <h2 class="mb-4">{{ __('Logo and Favicon Settings') }}</h2>

      <form action="{{ route('admin.settings.logo.update') }}" method="POST" id="x-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-12">
            <x-admin.image-preview width="150" src="{{ asset(config('settings.logo')) }}" alt="Logo" />
            <x-admin.input-text type="file" name="logo" :label="__('Logo')" :value="config('settings.logo')" />
          </div>

          <div class="col-md-12">
            <x-admin.image-preview width="150" src="{{ asset(config('settings.footer_logo')) }}" alt="Footer Logo" />
            <x-admin.input-text type="file" name="footer_logo" :label="__('Footer Logo')" :value="config('settings.footer_logo')" />
          </div>

          <div class="col-md-12">
            <x-admin.image-preview width="24" src="{{ asset(config('settings.favicon')) }}" alt="Favicon" />
            <x-admin.input-text type="file" name="favicon" :label="__('Favicon')" :value="config('settings.favicon')" />
          </div>

          <div class="col-md-12">
            <x-admin.image-preview width="350" src="{{ asset(config('settings.breadcrumb')) }}" alt="Breadcrumb" />
            <x-admin.input-text type="file" name="breadcrumb" :label="__('Breadcrumb')" :value="config('settings.breadcrumb')" />
          </div>
        </div>
      </form>

    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <x-admin.submit-button :label="__('Save')" onclick="$('#x-form').submit()" />
      </div>
    </div>
  </div>
@endsection

