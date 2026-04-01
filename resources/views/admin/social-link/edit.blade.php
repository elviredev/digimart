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
            <h3 class="card-title">{{ __('Update Social Link') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.social-links.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.social-links.update', $socialLink->id) }}" class="x-form" method="POST">
              @csrf
              @method('PUT')

              <x-admin.input-icon name="icon" :label="__('Social Link Icon')" :value="$socialLink->icon" />
              <x-admin.input-text name="url" :label="__('URL')" :value="$socialLink->url" />
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update')" onclick="$('.x-form').submit()" />
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