{{--<x-guest-layout>--}}
{{--  <form--}}
{{--    method="POST"--}}
{{--    action="{{ route('admin.password.store') }}">--}}
{{--    @csrf--}}

{{--    <!-- Password Reset Token -->--}}
{{--    <input--}}
{{--      type="hidden"--}}
{{--      name="token"--}}
{{--      value="{{ $request->route('token') }}">--}}

{{--    <!-- Email Address -->--}}
{{--    <div>--}}
{{--      <x-input-label--}}
{{--        for="email"--}}
{{--        :value="__('Email')"/>--}}
{{--      <x-text-input--}}
{{--        id="email"--}}
{{--        class="block mt-1 w-full"--}}
{{--        type="email"--}}
{{--        name="email"--}}
{{--        :value="old('email', $request->email)"--}}
{{--        required--}}
{{--        autofocus--}}
{{--        autocomplete="username"/>--}}
{{--      <x-input-error--}}
{{--        :messages="$errors->get('email')"--}}
{{--        class="mt-2"/>--}}
{{--    </div>--}}

{{--    <!-- Password -->--}}
{{--    <div--}}
{{--      class="mt-4">--}}
{{--      <x-input-label--}}
{{--        for="password"--}}
{{--        :value="__('Password')"/>--}}
{{--      <x-text-input--}}
{{--        id="password"--}}
{{--        class="block mt-1 w-full"--}}
{{--        type="password"--}}
{{--        name="password"--}}
{{--        required--}}
{{--        autocomplete="new-password"/>--}}
{{--      <x-input-error--}}
{{--        :messages="$errors->get('password')"--}}
{{--        class="mt-2"/>--}}
{{--    </div>--}}

{{--    <!-- Confirm Password -->--}}
{{--    <div--}}
{{--      class="mt-4">--}}
{{--      <x-input-label--}}
{{--        for="password_confirmation"--}}
{{--        :value="__('Confirm Password')"/>--}}

{{--      <x-text-input--}}
{{--        id="password_confirmation"--}}
{{--        class="block mt-1 w-full"--}}
{{--        type="password"--}}
{{--        name="password_confirmation"--}}
{{--        required--}}
{{--        autocomplete="new-password"/>--}}

{{--      <x-input-error--}}
{{--        :messages="$errors->get('password_confirmation')"--}}
{{--        class="mt-2"/>--}}
{{--    </div>--}}

{{--    <div--}}
{{--      class="flex items-center justify-end mt-4">--}}
{{--      <x-primary-button>--}}
{{--        {{ __('Reset Password') }}--}}
{{--      </x-primary-button>--}}
{{--    </div>--}}
{{--  </form>--}}
{{--</x-guest-layout>--}}

  <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>{{ __('Admin Login') }}</title>
  <!-- CSS files -->
  <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet"/>
  <style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>
<body  class=" d-flex flex-column">
<div class="page page-center">
  <div class="container container-tight py-4">
    <div class="text-center mb-4">
      <a href="." class="navbar-brand navbar-brand-autodark">
        <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
      </a>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="h2 text-center mb-4">{{ __('Reset your password') }}</h2>
        <form method="POST" action="{{ route('admin.password.store') }}">
          @csrf

          <!-- Password Reset Token -->
          <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
          >

          <!-- Email -->
          <div class="mb-3">
            <label class="form-label">{{ __('Email address') }}</label>
            <input
              type="email" name="email"
              class="form-control" placeholder="your@email.com"
              autocomplete="off" value="{{ old('email', $request->email) }}"
              required
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mb-2">
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-group input-group-flat">
              <input
                id="password"
                type="password"
                name="password"
                class="form-control"
                placeholder="Your new password"
                autocomplete="current-password"
                required
              >
              <span class="input-group-text">
                <a
                  href="#"
                  class="toggle-password link-secondary"
                  data-target="password"
                >
                  <span class="password-icon"></span>
                </a>
              </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <div class="mb-2">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group input-group-flat">
              <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="Confirm new password"
                autocomplete="off"
              />
              <span class="input-group-text">
                <a
                  href="#"
                  class="toggle-password link-secondary"
                  data-target="password_confirmation"
                >
                  <span class="password-icon"></span>
                </a>
              </span>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
              {{ __('Reset Password') }}
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>

<!-- Show Password -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const eyeSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
        fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6
                 c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
      </svg>
    `

    const eyeOffSvg = `
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
        fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 3l18 18"/>
        <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
        <path d="M9.363 5.365c.823 -.23 1.714 -.365 2.637 -.365
                 c3.6 0 6.6 2 9 6a17.888 17.888 0 0 1 -1.546 2.204"/>
        <path d="M6.53 6.53a17.888 17.888 0 0 0 -3.53 5.47
                 c2.4 4 5.4 6 9 6c.933 0 1.83 -.136 2.653 -.368"/>
      </svg>
    `

    document.querySelectorAll('.toggle-password').forEach(toggle => {
      const input = document.getElementById(toggle.dataset.target)
      const icon = toggle.querySelector('.password-icon')

      // icône initiale
      icon.innerHTML = eyeSvg;

      toggle.addEventListener('click', (e) => {
        e.preventDefault()

        const isPassword = input.type === 'password'
        input.type = isPassword ? 'text' : 'password'
        icon.innerHTML = isPassword ? eyeOffSvg : eyeSvg
        toggle.title = isPassword ? 'Hide password' : 'Show password'
      });
    })
  });
</script>
</body>
</html>

