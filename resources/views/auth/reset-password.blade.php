@extends('frontend.layouts.master')

@section('content')
  <!-- ======================== Breadcrumb Two Section Start ===================== -->
  <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
  style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
    <div class="breadcrumb-two">
      <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}"
      alt="" class="bg--gradient">
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
                  <span class="breadcrumb-list__text">{{ __('Reset Password') }}</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">
                {{ __('Reset Password') }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- ======================== Formulaire Section Start ===================== -->
  <section class="wsus__login padding-y-120">
    <div class="container">
      <div class="row">
        <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">

          <div class="wsus__login_area">
            <form method="POST" action="{{ route('password.store') }}">
              @csrf

              <!-- Password Reset Token -->
              <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="row">
                <div class="col-xl-12">
                  <div class="wsus__login_imput">
                    <label>{{ __('email') }}</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}"
                    placeholder="Email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>

                  <div class="wsus__login_imput">
                    <label>{{ __('password') }}</label>
                    <input type="password" name="password"  placeholder="Your new password" autocomplete="new-password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                  <div class="wsus__login_imput">
                    <label>{{ __('confirm password') }}</label>
                    <input type="password" name="password_confirmation"  placeholder="Confirm new password" autocomplete="new-password" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
                </div>

                <div class="col-xl-12">
                  <div class="wsus__login_imput">
                    <button type="submit" class="btn btn-main btn-lg">
                      {{ __('Reset Password') }}
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Formulaire Section End ===================== -->
@endsection





