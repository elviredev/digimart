@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/ez-icon-picker.css') }}">
@endpush

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Create Category') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.categories.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <x-admin.input-icon name="icon" :label="__('Category Icon')" />
                </div>

                <div class="col-md-12">
                  <x-admin.input-text name="name" :label="__('Category Name')" required="required" />
                </div>

                <div class="col-md-12">
                  <x-admin.input-text name="file_types" :label="__('File Types')" data-role="tagsinput" :hint="__('The allowed files to be uploaded as main file, like ZIP, MP3, MP4, PNG, JPG, etc')" />
                </div>
                <hr class="mt-2 mb-4">

                <div class="col-md-4">
                  <x-admin.input-toggle name="show_at_nav" :label="__('Show at nav')" />
                </div>

                <div class="col-md-4">
                  <x-admin.input-toggle name="show_at_featured" :label="__('Show at featured')" />
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Create Category')" onclick="$('form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/admin/js/ez-icon-picker.iife.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    new EzIconPicker({
      selector: '.icon-picker'
    });
  });
</script>
@endpush