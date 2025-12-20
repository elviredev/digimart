<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>{{ __('Admin Forget Password') }}</title>
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
        <img src="{{ asset('assets/admin/img/logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
      </a>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="card card-md" method="POST" action="{{ route('admin.password.email') }}">
      @csrf

      <div class="card-body">
        <h2 class="card-title text-center mb-4">{{ __('Admin Forget Password') }}</h2>
        <p class="text-secondary mb-4">
          {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control"
            placeholder="your@email.com"
            autocomplete="off" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">
            {{ __('Email Password Reset Link') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>
</body>
</html>
