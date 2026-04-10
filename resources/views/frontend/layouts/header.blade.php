@php
  $categories = \App\Models\Category::with('subCategories')->get();
  $cartCount = \App\Models\CartItem::where('user_id', user()?->id)->count();
  $flashBanner = \App\Models\FlashSaleBanner::first();
  $customPages = \App\Models\CustomPage::where(['status' => 1, 'show_at_nav' => 1])->get();
@endphp

<!-- ============================ Sale Offer Start =========================== -->
@if ($flashBanner->status == 1)
<div class="sale-offer ">
  <div class="container container-full ">
    <div class="sale-offer__content flx-between position-relative">
      <div class="sale-offer__countdown">

        {{-- <div class="countdown" data-date="14-10-2026" data-time="12:00">
          <div class="day"><span class="num"></span><span class="word"></span></div>
          <div class="hour"><span class="num"></span><span class="word"></span></div>
          <div class="min"><span class="num"></span><span class="word"></span></div>
          <div class="sec"><span class="num"></span><span class="word"></span></div>
        </div> --}}

      </div>
      <div class="sale-offer__discount flx-align gap-2">
        <span class="sale-offer__text text-heading text-capitalize">{{ $flashBanner?->title }}</span>
        <strong class="sale-offer__qty text-heading font-heading">{{ $flashBanner?->offer }}</strong>
        <a href="{{ $flashBanner?->button_url }}" class="btn btn-sm btn-white fw-500">{{ $flashBanner?->button_text }}</a>
      </div>
      <div class="sale-offer__button">
        <button type="submit" class="sale-offer__close text-heading"><i
          class="las la-times"></i></button>
      </div>
    </div>
  </div>
</div>
@endif
<!-- ============================ Sale Offer End =========================== -->

<!-- ==================== Header Start Here ==================== -->
<header class="header">
  <div class="container container-full">
    <nav class="header-inner flx-between">
      <!-- Logo Start -->
      <div class="logo">
        <a href="{{ route('home') }}" class="link white-version">
          <img src="{{ asset(config('settings.logo')) }}" alt="Logo">
        </a>
      </div>
      <!-- Logo End  -->

      <!-- Menu Start  -->
      <div class="header-menu d-lg-block d-none">
        <ul class="nav-menu flx-align ">
          <li class="nav-menu__item">
            <a href="{{ route('home') }}" class="nav-menu__link">{{ __('Home') }}</a>
          </li>
          <li class="nav-menu__item">
            <a href="{{ route('products') }}" class="nav-menu__link">{{ __('Products') }}</a>
          </li>
          <li class="nav-menu__item">
            <a href="{{ route('contact') }}" class="nav-menu__link">{{ __('Contact') }}</a>
          </li>

          @foreach ($customPages as $page)
            <li class="nav-menu__item">
              <a href="{{ route('page', $page->slug) }}" class="nav-menu__link">{{ $page->name }}</a>
            </li>
          @endforeach

          <li class="nav-menu__item">
            <a href="{{ route('kyc.index') }}" class="nav-menu__link">{{ __('Start Selling') }}</a>
          </li>
        </ul>
      </div>
      <!-- Menu End  -->

      <!-- Header Right start -->
      <div class="header-right flx-align">
        <a href="{{ route('cart.index') }}" class="header-right__button cart-btn position-relative">
          <i class="ti ti-basket"></i>
          <span class="qty-badge font-12" id="cart-count">{{ $cartCount }}</span>
        </a>

        <div class="header-right__inner gap-3 flx-align d-lg-flex d-none">
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
              <img src="{{ asset('assets/frontend/images/icons/user.svg') }}" alt="user icon">
            </button>
            <ul class="dropdown-menu">
              @guest
                <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Sign In') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
              @endguest
              @auth
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
              @endauth
            </ul>
          </div>
        </div>
        <button type="button" class="toggle-mobileMenu d-lg-none"> <i class="las la-bars"></i> </button>
      </div>
      <!-- Header Right End  -->
    </nav>
  </div>
</header>
<!-- ==================== Header End Here ==================== -->

<!-- ==================== Category Menu Start ==================== -->
<section class="category_menu_area d-none d-lg-block">
  <div class="container container-full">
    <ul class="category_menu">
      @foreach ($categories as $category)
        <li class="category_menu_list {{ $category->subCategories->count() > 0 ? 'has-submenu' : '' }}">
          <a class="category_menu_link" href="{{ route('products', ['category' => $category->slug]) }}">
            {{ $category->name }}
          </a>

          @if($category->subCategories->count() > 0)
            <ul class="nav-submenu">
              @foreach ($category->subCategories as $subCategory)
                <li class="nav-submenu__item">
                  <a href="{{ route('products', ['category' => $category->slug, 'sub-category' => $subCategory->slug]) }}" class="nav-submenu__link">{{ $subCategory->name }}</a>
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</section>
<!-- ==================== Category Menu End ==================== -->