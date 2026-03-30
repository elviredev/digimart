@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Banner One') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.banner-one.update') }}" class="x-form-one" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="py-3">
                  <x-admin.image-preview width="150px" src="{{ asset($bannerSection?->background_image_one) }}" alt="Banner Background One" />
                </div>
                <div class="col-12">
                  <x-admin.input-text type="file" name="background_image_one" :label="__('Banner Background One')" />
                </div>

                <div class="col-12">
                  <x-admin.input-text name="banner_title_one" :label="__('Title One')" :value="$bannerSection?->banner_title_one" />
                </div>
                <div class="col-12">
                  <x-admin.input-text name="banner_subtitle_one" :label="__('Subtitle One')" :value="$bannerSection?->banner_subtitle_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="button_text_one" :label="__('Button Text One')" :value="$bannerSection?->button_text_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="button_url_one" :label="__('Button URL One')" :value="$bannerSection?->button_url_one" />
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update')" onclick="$('.x-form-one').submit()" />
          </div>
        </div>

        <br>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Banner Two') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.banner-two.update') }}" class="x-form-two" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="py-3">
                  <x-admin.image-preview width="150px" src="{{ asset($bannerSection?->background_image_two) }}" alt="Banner Background Two" />
                </div>
                <div class="col-12">
                  <x-admin.input-text type="file" name="background_image_two" :label="__('Banner Background Two')" />
                </div>

                <div class="col-12">
                  <x-admin.input-text name="banner_title_two" :label="__('Title Two')" :value="$bannerSection?->banner_title_two" />
                </div>
                <div class="col-12">
                  <x-admin.input-text name="banner_subtitle_two" :label="__('Subtitle Two')" :value="$bannerSection?->banner_subtitle_two" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="button_text_two" :label="__('Button Text Two')" :value="$bannerSection?->button_text_two" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="button_url_two" :label="__('Button URL Two')" :value="$bannerSection?->button_url_two" />
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update')" onclick="$('.x-form-two').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection