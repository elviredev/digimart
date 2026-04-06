@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Flash Sale Banner') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.flash-banner.update', 1) }}" method="POST" class="x-form">
              @csrf
              @method('PUT')

              <x-admin.input-text name="title" :label="__('Title')" :value="$flashBanner?->title" />
              <x-admin.input-text name="offer" :label="__('Offer')" :value="$flashBanner?->offer" />
              <x-admin.input-text name="button_text" :label="__('Button Text')" :value="$flashBanner?->button_text" />
              <x-admin.input-text name="button_url" :label="__('Button URL')" :value="$flashBanner?->button_url" />
              <x-admin.input-toggle name="status" :label="__('Status')" :checked="$flashBanner?->status" />
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