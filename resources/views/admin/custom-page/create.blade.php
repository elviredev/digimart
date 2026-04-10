@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Create New Page') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.custom-page.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.custom-page.store') }}" method="POST" class="x-form">
              @csrf

              <x-admin.input-text name="name" :label="__('Name')" />
              <x-admin.input-textarea id="editor" name="content" :label="__('Content')" />

              <x-admin.input-toggle name="show_at_nav" :label="__('Show at Nav')" />
              <x-admin.input-toggle name="status" :label="__('Status')" />
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Create Custom Page')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection