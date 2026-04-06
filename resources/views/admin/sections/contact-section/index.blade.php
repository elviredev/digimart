@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Contact Informations') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.contact-section.update', 1) }}" method="POST" class="x-form">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-6">
                  <x-admin.input-text name="phone_one" :label="__('Phone One')" :value="$contactInfo?->phone_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="phone_two" :label="__('Phone Two')" :value="$contactInfo?->phone_two" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="email_one" :label="__('Email One')" :value="$contactInfo?->email_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="email_two" :label="__('Email Two')" :value="$contactInfo?->email_two" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="link_one" :label="__('Link One')" :value="$contactInfo?->link_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="link_two" :label="__('Link Two')" :value="$contactInfo?->link_two" />
                </div>

                <div class="col-md-12">
                  <x-admin.input-textarea name="map" :label="__('Map')" :value="$contactInfo?->map" />
                </div>
              </div>
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