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

          <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <x-admin.input-icon name="icon" :label="__('Category Icon')" :value="$category->icon" />
                </div>

                <div class="col-md-12">
                  <x-admin.input-text name="name" :label="__('Category Name')" required="required" :value="$category->name" />
                </div>

                <div class="col-md-12">
                  <x-admin.input-text
                    name="file_types"
                    :label="__('File Types')"
                    data-role="tagsinput"
                    :value="implode(',', $category->file_types)"
                    :hint="__('The allowed files to be uploaded as main file, like zip, rar, mp3, mp4, png, jpg, etc')"
                  />
                </div>

                <hr class="mt-2 mb-4">

                <div class="col-md-4">
                  <x-admin.input-toggle name="show_at_nav" :label="__('Show at nav')" :checked="$category->show_at_nav" />
                </div>

                <div class="col-md-4">
                  <x-admin.input-toggle name="show_at_featured" :label="__('Show at featured')" :checked="$category->show_at_featured" />
                </div>
              </div>
            </div>

            <div class="card-footer text-end">
              <x-admin.submit-button :label="__('Update Category')" />
            </div>
          </form>
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