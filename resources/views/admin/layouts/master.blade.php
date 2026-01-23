<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>Dashboard</title>
  <!-- Notyf JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
  <!-- Tabler Icons CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
  integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap Tags Input -->
  <link href="{{ asset('assets/admin/css/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
  <!-- Select 2 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">

  <!-- CSS files -->
  <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo.svg') }}" type="image/x-icon"/>
  <link href="{{ asset('assets/admin/css/tabler.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet"/>
  @stack('styles')

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
<body >
  <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
  <div class="page">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Contenu dynamique -->
    @yield('content')
  </div>

  <!-- jQuery -->
  <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Notyf JS -->
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  <!-- Bootstrap Tags Input -->
  <script src="{{ asset('assets/admin/js/bootstrap-tagsinput.min.js') }}"></script>
  <!-- select 2  -->
  <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>

  <!-- Tabler Core -->
  <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
  <script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>

  <!-- Admin JS -->
  <script src="{{ asset('assets/admin/js/default/admin.js') }}" defer></script>

  @stack('scripts')

</body>
</html>