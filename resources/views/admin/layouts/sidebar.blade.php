<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#sidebar-menu"
      aria-controls="sidebar-menu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href=".">
        <img
          src="{{ asset('assets/admin/img/logo.svg') }}"
          width="110"
          height="32"
          alt="Tabler"
          class="navbar-brand-image"
        />
      </a>
    </h1>
    <div class="navbar-nav flex-row d-lg-none">
      <div class="d-none d-lg-flex ">
        <a
          href="?theme=dark"
          class="nav-link px-0 hide-theme-dark"
          title="Enable dark mode"
          data-bs-toggle="tooltip"
          data-bs-placement="bottom"
        >
          <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"
            />
          </svg>
        </a>
        <a
          href="?theme=light"
          class="nav-link px-0 hide-theme-light"
          title="Enable light mode"
          data-bs-toggle="tooltip"
          data-bs-placement="bottom"
        >
          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path
              d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"
            />
          </svg>
        </a>
      </div>
      <div class="nav-item dropdown">
        <a
          href="javascript:;"
          class="nav-link d-flex lh-1 text-reset p-0"
          data-bs-toggle="dropdown"
          aria-label="Open user menu"
        >
          <span
            class="avatar avatar-sm"
            style="background-image: url({{ asset(admin()->avatar) }})"
          ></span>
          <div class="d-none d-xl-block ps-2">
            <div>{{ admin()->name }}</div>
            <div class="mt-1 small text-secondary">{{ admin()->email }}</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{ route('admin.profile.index') }}" class="dropdown-item">{{ __('Profile') }}</a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.settings.index') }}" class="dropdown-item">{{ __('Settings') }}</a>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf

            <a
            href="javascript:;"
            class="dropdown-item"
            onclick="event.preventDefault(); this.closest('form').submit();"
            >{{ __('Logout') }}</a>
          </form>
        </div>
      </div>
    </div>

    {{-- Sidebar --}}
    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item ">
          <a class="nav-link {{ setSidebarActive(['admin.dashboard']) }}" href="{{ route('admin.dashboard') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-home sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Home') }}</span>
          </a>
        </li>

        @if(canAccess(['manage categories']))
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle
              {{ setSidebarActive([
                'admin.categories.index',
                'admin.sub-categories.index'
                ]) == 'active' ? 'show' : '' }}"
              href="#"
              data-bs-toggle="dropdown"
              data-bs-auto-close="false"
              role="button"
              aria-expanded="true"
            >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="ti ti-category sidebar-icon"></i>
              </span>
              <span class="nav-link-title">{{ __('Manage Categories') }}</span>
            </a>
            <div class="dropdown-menu
            {{ setSidebarActive([
              'admin.categories.index',
              'admin.sub-categories.index'
              ]) == 'active' ? 'show' : '' }}">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <a class="dropdown-item {{ setSidebarActive(['admin.categories.index']) }}" href="{{ route('admin.categories.index') }}">
                    {{ __('Main Categories') }}
                  </a>
                  <a class="dropdown-item {{ setSidebarActive(['admin.sub-categories.index']) }}" href="{{ route('admin.sub-categories.index') }}">
                    {{ __('Sub Categories') }}
                  </a>
                </div>
              </div>
            </div>
          </li>
        @endif

        @if(canAccess(['manage orders']))
        <li class="nav-item dropdown">
          <a
          class="nav-link dropdown-toggle
          {{ setSidebarActive([
            'admin.orders.index'
            ]) == 'active' ? 'show' : '' }}"
          href="{{ route('admin.kyc-settings.index') }}"
          data-bs-toggle="dropdown"
          data-bs-auto-close="false"
          role="button"
          aria-expanded="true"
          >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-shopping-cart sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Manage Orders') }}</span>
          </a>
          <div class="dropdown-menu
            {{ setSidebarActive([
              'admin.orders.index'
              ]) == 'active' ? 'show' : '' }}">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.orders.index']) }}" href="{{ route('admin.orders.index') }}">
                  {{ __('Orders') }}
                  <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">
                    0
                  </span>
                </a>
              </div>
            </div>
          </div>
        </li>
        @endif

        @if(canAccess(['review products']))
          <li class="nav-item dropdown">
            <a
            class="nav-link dropdown-toggle
            {{ setSidebarActive([
              'admin.item-reviews.pending.index',
              'admin.item-reviews.resubmitted.index',
              'admin.item-reviews.soft-rejected.index',
              'admin.item-reviews.hard-rejected.index',
              'admin.item-reviews.approved.index'
              ]) == 'active' ? 'show' : '' }}"
            href="{{ route('admin.kyc-settings.index') }}"
            data-bs-toggle="dropdown"
            data-bs-auto-close="false"
            role="button"
            aria-expanded="true"
            >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-basket-bolt sidebar-icon"></i>
            </span>
              <span class="nav-link-title">{{ __('Product Review') }}</span>
            </a>
            <div
              class="dropdown-menu
              {{ setSidebarActive([
                'admin.item-reviews.pending.index',
                'admin.item-reviews.resubmitted.index',
                'admin.item-reviews.soft-rejected.index',
                'admin.item-reviews.hard-rejected.index',
                'admin.item-reviews.approved.index'
                ]) == 'active' ? 'show' : '' }}">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <a class="dropdown-item {{ setSidebarActive(['admin.item-reviews.pending.index']) }}" href="{{ route('admin.item-reviews.pending.index') }}">
                    {{ __('Pending') }}
                    <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">
                    {{ getItemStatusCount('pending') }}
                  </span>
                  </a>
                  <a class="dropdown-item {{ setSidebarActive(['admin.item-reviews.resubmitted.index']) }}" href="{{ route('admin.item-reviews.resubmitted.index') }}">
                    {{ __('Resubmitted') }}
                    <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">
                    {{ getItemStatusCount('resubmitted') }}
                  </span>
                  </a>
                  <a class="dropdown-item {{ setSidebarActive(['admin.item-reviews.soft-rejected.index']) }}" href="{{ route('admin.item-reviews.soft-rejected.index') }}">
                    {{ __('Soft Rejected') }}
                  </a>
                  <a class="dropdown-item {{ setSidebarActive(['admin.item-reviews.hard-rejected.index']) }}" href="{{ route('admin.item-reviews.hard-rejected.index') }}">
                    {{ __('Hard Rejected') }}
                  </a>
                  <a class="dropdown-item {{ setSidebarActive(['admin.item-reviews.approved.index']) }}" href="{{ route('admin.item-reviews.approved.index') }}">
                    {{ __('Approved') }}
                  </a>
                </div>
              </div>
            </div>
          </li>
        @endif

        @if(canAccess(['manage kyc']))
        <li class="nav-item dropdown">
          <a
          class="nav-link dropdown-toggle
          {{ setSidebarActive([
            'admin.kyc.index',
            'admin.kyc-settings.index'
            ]) == 'active' ? 'show' : '' }}"
          href="{{ route('admin.kyc-settings.index') }}"
          data-bs-toggle="dropdown"
          data-bs-auto-close="false"
          role="button"
          aria-expanded="true"
          >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-e-passport sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('KYC') }}</span>
          </a>
          <div class="dropdown-menu
            {{ setSidebarActive([
              'admin.kyc.index',
              'admin.kyc-settings.index'
              ]) == 'active' ? 'show' : '' }}"
          >
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.kyc.index']) }}" href="{{ route('admin.kyc.index') }}">
                  {{ __('KYC Requests') }}
                  <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">
                    {{ pendingKycCount() }}
                  </span>
                </a>
                <a class="dropdown-item {{ setSidebarActive(['admin.kyc-settings.index']) }}" href="{{ route('admin.kyc-settings.index') }}">
                  {{ __('KYC Settings') }}
                </a>
              </div>
            </div>
          </div>
        </li>
        @endif

        @if(canAccess(['manage withdraw request']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.withdraw-requests.index']) }}" href="{{ route('admin.withdraw-requests.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-user-dollar sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Withdraw Requests') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage withdraw method']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.withdrawal-methods.index']) }}" href="{{ route('admin.withdrawal-methods.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-credit-card sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Withdraw Methods') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage sections']))
        <li class="nav-item dropdown">
          <a
          class="nav-link dropdown-toggle
          {{ setSidebarActive([
            'admin.hero-section.index',
            'admin.featured-categories-section.index',
            'admin.highlighted-products-section.index',
            'admin.monthly-picked-products-section.index',
            'admin.featured-author-section.index',
            'admin.counter-section.index',
            'admin.banner-section.index',
            'admin.footer-section.index',
            'admin.contact-section.index'
            ]) == 'active' ? 'show' : '' }}"
          href="#"
          data-bs-toggle="dropdown"
          data-bs-auto-close="false"
          role="button"
          aria-expanded="true"
          >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-section sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Sections') }}</span>
          </a>
          <div class="dropdown-menu
          {{ setSidebarActive([
            'admin.hero-section.index',
            'admin.featured-categories-section.index',
            'admin.highlighted-products-section.index',
            'admin.monthly-picked-products-section.index',
            'admin.featured-author-section.index',
            'admin.counter-section.index',
            'admin.banner-section.index',
            'admin.footer-section.index',
            'admin.contact-section.index'
            ]) == 'active' ? 'show' : '' }}">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.hero-section.index']) }}" href="{{ route('admin.hero-section.index') }}">
                  {{ __('Hero Section') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.featured-categories-section.index']) }}" href="{{ route('admin.featured-categories-section.index') }}">
                  {{ __('Featured Categories') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.highlighted-products-section.index']) }}" href="{{ route('admin.highlighted-products-section.index') }}">
                  {{ __('Highlighted Products') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.monthly-picked-products-section.index']) }}" href="{{ route('admin.monthly-picked-products-section.index') }}">
                  {{ __('Monthly Products') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.featured-author-section.index']) }}" href="{{ route('admin.featured-author-section.index') }}">
                  {{ __('Featured Author') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.counter-section.index']) }}" href="{{ route('admin.counter-section.index') }}">
                  {{ __('Counter Section') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.banner-section.index']) }}" href="{{ route('admin.banner-section.index') }}">
                  {{ __('Banner Section') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.footer-section.index']) }}" href="{{ route('admin.footer-section.index') }}">
                  {{ __('Footer Section') }}
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.contact-section.index']) }}" href="{{ route('admin.contact-section.index') }}">
                  {{ __('Contact Section') }}
                </a>
              </div>
            </div>
          </div>
        </li>
        @endif

        @if(canAccess(['manage socials']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.social-links.index']) }}" href="{{ route('admin.social-links.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-social sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Social Links') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage banner']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.flash-banner.index']) }}" href="{{ route('admin.flash-banner.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-flag-3 sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Flash Banner') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage custom pages']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.custom-page.index']) }}" href="{{ route('admin.custom-page.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-layout-grid-add sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Custom page') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage newsletter']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.subscribers.index']) }}" href="{{ route('admin.subscribers.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-article sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Subscribers') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['access management']))
        <li class="nav-item dropdown">
          <a
          class="nav-link dropdown-toggle
          {{ setSidebarActive([
            'admin.role-users.index',
            'admin.roles.index'
            ]) == 'active' ? 'show' : '' }}"
          href="{{ route('admin.role-users.index') }}"
          data-bs-toggle="dropdown"
          data-bs-auto-close="false"
          role="button"
          aria-expanded="true"
          >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-shield-cog sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Access Management') }}</span>
          </a>
          <div class="dropdown-menu
            {{ setSidebarActive([
              'admin.role-users.index',
              'admin.roles.index'
              ]) == 'active' ? 'show' : '' }}">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item {{ setSidebarActive(['admin.role-users.index']) }}" href="{{ route('admin.role-users.index') }}">
                  {{ __('Role Users') }}
                </a>
                <a class="dropdown-item {{ setSidebarActive(['admin.roles.index']) }}" href="{{ route('admin.roles.index') }}">
                  {{ __('Role & Permissions') }}
                </a>
              </div>
            </div>
          </div>
        </li>
        @endif

        @if(canAccess(['payment setting']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.payment-settings.index']) }}" href="{{ route('admin.payment-settings.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-settings-dollar sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Payment Settings') }}</span>
          </a>
        </li>
        @endif

        @if(canAccess(['manage settings']))
        <li class="nav-item">
          <a class="nav-link {{ setSidebarActive(['admin.settings.index']) }}" href="{{ route('admin.settings.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-settings sidebar-icon"></i>
            </span>
            <span class="nav-link-title">{{ __('Settings') }}</span>
          </a>
        </li>
        @endif

      </ul>
    </div>
  </div>
</aside>

<!-- Top Navbar -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
  <div class="container-xl">
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbar-menu"
      aria-controls="navbar-menu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav flex-row order-md-last">
      <div class="d-none d-md-flex me-3">
        <a
          href="?theme=dark"
          class="nav-link px-0 hide-theme-dark"
          data-bs-toggle="tooltip"
          data-bs-placement="bottom"
          aria-label="Enable dark mode"
          data-bs-original-title="Enable dark mode"
        >
          <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path
              d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"
            ></path>
          </svg>
        </a>
        <a
          href="?theme=light"
          class="nav-link px-0 hide-theme-light"
          data-bs-toggle="tooltip"
          data-bs-placement="bottom"
          aria-label="Enable light mode"
          data-bs-original-title="Enable light mode"
        >
          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
            <path
              d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"
            ></path>
          </svg>
        </a>

      </div>
      <div class="nav-item dropdown">
        <a
          href="javascript:;"
          class="nav-link d-flex lh-1 text-reset p-0"
          data-bs-toggle="dropdown"
          aria-label="Open user menu"
        >
          <span
            class="avatar avatar-sm"
            style="background-image: url({{ asset(admin()->avatar) }})"
          ></span>
          <div class="d-none d-xl-block ps-2">
            <div>{{ admin()->name }}</div>
            <div class="mt-1 small text-secondary">{{ admin()->email }}</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="{{ route('admin.profile.index') }}" class="dropdown-item">{{ __('Profile') }}</a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.settings.index') }}" class="dropdown-item">{{ __('Settings') }}</a>

          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf

            <a
              href="javascript:;"
              class="dropdown-item"
              onclick="event.preventDefault(); this.closest('form').submit();"
            >
              {{ __('Logout') }}
            </a>
          </form>
        </div>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar-menu"></div>
  </div>
</header>
