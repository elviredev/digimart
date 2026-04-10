@extends('frontend.layouts.master')

@section('content')
  <!-- ======================== Breadcrumb Two Section Start ===================== -->
  <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
  style="background: url({{ asset(config('settings.breadcrumb')) }});">
    <div class="breadcrumb-two">
      <img src="{{ asset(config('settings.breadcrumb')) }}" alt="" class="bg--gradient">
      <div class="container container-two">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="breadcrumb-two-content text-center">

              <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                <li class="breadcrumb-list__item font-14 text-body">
                  <a href="{{ route('home') }}"
                  class="breadcrumb-list__link text-body hover-text-main">
                    {{ __('Home') }}
                  </a>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__icon font-10">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__text">{{ __('Contact Us') }}</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ __('Contact Us') }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- =========================== Contact Section Start ========================== -->
  <section class="wsus__contact_us padding-y-120">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-md-6 col-lg-4">
          <div class="wsus__contact_single_info">
            <span><i class="fas fa-phone-alt"></i></span>
            <a href="callto:{{ $contactInfo?->phone_one }}">{{ $contactInfo?->phone_one }}</a>
            <a href="callto:{{ $contactInfo?->phone_two }}">{{ $contactInfo?->phone_two }}</a>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-lg-4">
          <div class="wsus__contact_single_info">
            <span><i class="fas fa-envelope"></i></span>
            <a href="mailto:{{ $contactInfo?->email_one }}">{{ $contactInfo?->email_one }}</a>
            <a href="mailto:{{ $contactInfo?->email_two }}">{{ $contactInfo?->email_two }}</a>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-lg-4">
          <div class="wsus__contact_single_info">
            <span><i class="fas fa-globe"></i></span>
            <a href="{{ $contactInfo?->link_one }}" target="_blank">{{ $contactInfo?->link_one }}</a>
            <a href="{{ $contactInfo?->link_two }}" target="_blank">{{ $contactInfo?->link_two }}</a>
          </div>
        </div>
      </div>
      <div class="row mt_120 xs_mt_80">
        <div class="col-xl-12 col-lg-12">
          <form action="{{ route('contact.send-mail') }}" method="POST" class="wsus__contact_form wsus__comment_input_area">
            @csrf

            <h3>{{ __('Feel Free to Get in Touch') }}</h3>
            <div class="row">
              <div class="col-xl-12">
                <div class="wsus__comment_single_input">
                  <fieldset>
                    <legend>{{ __('name') }}*</legend>
                    <input type="text" name="name" placeholder="Garikoka Thomash">
                  </fieldset>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="wsus__comment_single_input">
                  <fieldset>
                    <legend>{{ __('email') }}*</legend>
                    <input type="email" name="email" placeholder="infoyour@gmail.com">
                  </fieldset>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="wsus__comment_single_input">
                  <fieldset>
                    <legend>{{ __('subject') }}*</legend>
                    <input type="text" name="subject" placeholder="Your Subject">
                  </fieldset>
                </div>
              </div>
              <div class="col-xl-12">
                <div class="wsus__comment_single_input">
                  <fieldset>
                    <legend>{{ __('message') }}*</legend>
                    <textarea rows="6" name="message" placeholder="Write a Message"></textarea>
                  </fieldset>
                </div>
                <button class="btn btn-main btn-lg" type="submit">{{ __('Send Message') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-12">
      <div class="wsus__contact_map">
        {!! $contactInfo?->map !!}
      </div>
    </div>
  </section>
  <!-- =========================== Contact Section End ========================== -->
@endsection