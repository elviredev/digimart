<div class="dashboard-sidebar">
  <button type="button" class="dashboard-sidebar__close d-lg-none d-flex"><i
    class="las la-times"></i></button>
  <div class="dashboard-sidebar__inner">
    <a href="{{ route('home') }}" class="logo mb-48">
      <img src="{{ asset(config('settings.logo')) }}" alt="" class="white-version">
    </a>
    <a href="{{ route('home') }}" class="logo logo_icon favicon mb-48">
      <img src="{{ asset('assets/frontend/images/thumbs/dashboard_sidebar_icon.png') }}" alt="">
    </a>

    <!-- Sidebar List Start -->
    <ul class="sidebar-list">
      <li class="sidebar-list__item">
        <a href="{{ route('dashboard') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-device-heart-monitor"></i>
          </span>
          <span class="text">{{ __('Dashboard') }}</span>
        </a>
      </li>
      <li class="sidebar-list__item">
        <a href="{{ route('profile') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-user"></i>
          </span>
          <span class="text">{{ __('Profile') }}</span>
        </a>
      </li>

      @if(isAuthor())
        <li class="sidebar-list__item">
          <a href="{{ route('user.items.index') }}" class="sidebar-list__link">
            <span class="sidebar-list__icon">
              <i class="ti ti-building-store"></i>
            </span>
            <span class="text">{{ __('My Items') }}</span>
          </a>
        </li>

        <li class="sidebar-list__item">
          <a href="{{ route('sales.index') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-report-money"></i>
          </span>
            <span class="text">{{ __('Sales') }}</span>
          </a>
        </li>

        <li class="sidebar-list__item">
          <a href="{{ route('user.withdraws.index') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-pig-money"></i>
          </span>
            <span class="text">{{ __('Withdraws') }}</span>
          </a>
        </li>
      @endif

      <li class="sidebar-list__item">
        <a href="{{ route('reviews.index') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-stars"></i>
          </span>
          <span class="text">{{ __('Reviews') }}</span>
        </a>
      </li>

      <li class="sidebar-list__item">
        <a href="{{ route('orders.index') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-shopping-bag"></i>
          </span>
          <span class="text">{{ __('Purchases') }}</span>
        </a>
      </li>

      <li class="sidebar-list__item">
        <a href="{{ route('transactions.index') }}" class="sidebar-list__link">
          <span class="sidebar-list__icon">
            <i class="ti ti-cash-register"></i>
          </span>
          <span class="text">{{ __('Transactions') }}</span>
        </a>
      </li>
      <li class="sidebar-list__item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <a
            href="javascript:;"
            class="sidebar-list__link"
            onclick="event.preventDefault(); this.closest('form').submit();"
          >
            <span class="sidebar-list__icon">
              <i class="ti ti-logout"></i>
            </span>
            <span class="text">{{ __('Logout') }}</span>
          </a>
        </form>
      </li>
    </ul>
    <!-- Sidebar List End -->

  </div>
</div>