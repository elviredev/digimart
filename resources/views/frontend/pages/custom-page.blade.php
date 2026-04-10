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
                  <span class="breadcrumb-list__text">{{ $page->name }}</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ $page->name }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- =========================== Custom page Section Start ========================== -->
  <section class="wsus__contact_us padding-y-120">
    <div class="container">
      <div class="row mt_120 xs_mt_80">
        <div class="col-xl-12 col-lg-12">
          <div class="wsus__contact_form wsus__comment_input_area">
            {!! $page->content !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- =========================== Custom page Section End ========================== -->
@endsection