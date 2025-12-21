{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('frontend.layouts.master')

@section('content')
  <!-- ======================== Breadcrumb Two Section Start ===================== -->
  <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
  style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
    <div class="breadcrumb-two">
      <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient">
      <div class="container container-two">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="breadcrumb-two-content text-center">

              <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                <li class="breadcrumb-list__item font-14 text-body">
                  <a href="index.html"
                  class="breadcrumb-list__link text-body hover-text-main">Home</a>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__icon font-10"><i
                                      class="fas fa-chevron-right"></i></span>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__text">Sign In</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">Sign In</h3>
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
            <h2>Welcome back!</h2>
            <p>sign in to continue</p>
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="row">
                <div class="col-xl-12">
                  <div class="wsus__login_imput">
                    <label>email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="wsus__login_imput">
                    <label>password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="wsus__login_imput wsus__login_check_area">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value=""
                      id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        Remember Me
                      </label>
                    </div>
                    <a href="{{ route('password.request') }}">Forget Password ?</a>
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="wsus__login_imput">
                    <button type="submit" class="btn btn-main btn-lg">Sign in</button>
                  </div>
                </div>
              </div>
            </form>
            <p class="create_account">Dont’t have an account ? <a href="{{ route('register') }}">Sign Up</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Formulaire Section End ===================== -->

@endsection




