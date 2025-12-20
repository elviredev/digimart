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
        <img src="{{ asset('assets/admin/img/logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
      </a>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
        <form method="POST" action="{{ route('admin.login') }}">
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <label class="form-label">{{ __('Email address') }}</label>
            <input
              type="email" name="email"
              class="form-control" placeholder="your@email.com"
              autocomplete="off" value="{{ old('email') }}"
              required
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div
            class="mb-2">
            <label
              class="form-label"> {{ __('Password') }}
              <span
                class="form-label-description">
                <a
                  href="{{ route('admin.password.request') }}">{{ __('I forgot password') }}</a>
              </span>
            </label>
            <div
              class="input-group input-group-flat">
              <input
                id="password-input"
                type="password"
                name="password"
                class="form-control"
                placeholder="Your password"
                autocomplete="current-password"
                required>
              <span
                class="input-group-text">
                <a
                  href="#"
                  id="toggle-password"
                  class="link-secondary"
                  data-bs-toggle="tooltip">
                  <span
                    id="password-icon"></span>
                </a>
              </span>
            </div>
          </div>

          <!-- Remeber me -->
          <div class="mb-2">
            <label class="form-check">
              <input type="checkbox" name="remember" class="form-check-input"/>
              <span class="form-check-label">{{ __('Remember me on this device') }}</span>
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
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
    const toggle = document.getElementById('toggle-password');
    const input = document.getElementById('password-input');
    const icon = document.getElementById('password-icon');

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

    // icône initiale
    icon.innerHTML = eyeSvg;

    toggle.addEventListener('click', (e) => {
      e.preventDefault()

      const isPassword = input.type === 'password'
      input.type = isPassword ? 'text' : 'password'
      icon.innerHTML = isPassword ? eyeOffSvg : eyeSvg
      toggle.title = isPassword ? 'Hide password' : 'Show password'
    });
  });
</script>
</body>
</html>
