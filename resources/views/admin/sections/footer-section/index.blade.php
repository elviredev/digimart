@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Footer Section') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.footer-section.update', 1) }}" class="x-form" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <x-admin.input-textarea name="description" :label="__('Description')" :value="$footerSection?->description" />
              <x-admin.input-text name="items_sold" :label="__('Items Sold')" :value="$footerSection?->items_sold" />
              <x-admin.input-text name="community_earnings" :label="__('Community Earnings')" :value="$footerSection?->community_earnings" />
              <x-admin.input-text name="copyright" :label="__('Copyright')" :value="$footerSection?->copyright" />
              <x-admin.image-preview src="{{ asset($footerSection?->gateway_image) }}" class="mb-3" width="210px" alt="Gateway Image" />
              <x-admin.input-text type="file" name="gateway_image" :label="__('Gateway Image')" />
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