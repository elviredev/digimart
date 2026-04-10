@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Update Custom Page') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.custom-page.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.custom-page.update', $customPage->id) }}" method="POST" class="x-form">
              @csrf
              @method('PUT')

              <x-admin.input-text name="name" :label="__('Name')" :value="$customPage->name" />
              <x-admin.input-textarea id="editor" name="content" :label="__('Content')" :value="$customPage->content" />

              <x-admin.input-toggle name="show_at_nav" :label="__('Show at Nav')" :checked="$customPage->show_at_nav" />
              <x-admin.input-toggle name="status" :label="__('Status')" :checked="$customPage->status" />
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update Custom Page')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection