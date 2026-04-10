@php
  $footerSection = \App\Models\FooterSection::first();
  $socialLinks = \App\Models\SocialLink::all();
  $customPages = \App\Models\CustomPage::where(['status' => 1])->latest()->take(5)->get();
@endphp

<footer class="footer-section "
  style="background: url({{ asset('assets/frontend/images/shapes/footer-bg.png') }}"
>
  <div class="container">
    <div
      class="subscription pt_55 pb_45"
      style="background: url({{ asset('assets/frontend/images/thumbs/subscrib_bg.jpg') }})">
      <div class="row align-items-center">
        <div class="col-xl-6 col-lg-6 wow fadeInLeft"
        style="visibility: visible; animation-name: fadeInLeft;">
          <div class="subscription_text ">
            <h2>{{ __('Have a project? Create your website now.') }}</h2>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 wow fadeInRight"
        style="visibility: visible; animation-name: fadeInRight;">
          <div class="subscription_right">
            <form action="#" class="subscription_form" method="POST">
              @csrf

              <input type="email" placeholder="enter your mail" name="email">
              <button class="btn btn-main btn-lg subscribe-btn" type="submit">
                {{ __('Subscribe') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container container-two">
    <div class="row gy-5">
      <div class="col-xl-3 col-sm-6">
        <div class="footer-widget">
          <div class="footer-widget__logo">
            <a href="{{ route('home') }}">
              <img src="{{ asset('assets/frontend/images/logo/white-logo.png') }}" alt="">
            </a>
          </div>
          <p class="footer-widget__desc">
            {{ $footerSection?->description }}
          </p>
          <div class="footer-widget__social">
            <ul class="social-icon-list">
              @foreach ($socialLinks as $socialLink)
              <li class="social-icon-list__item">
                <a href="{{ $socialLink?->url }}" class="social-icon-list__link flx-center font-5">
                  <i class="{{ $socialLink?->icon }}"></i></a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 col-xs-6">
        <div class="footer-widget">
          <h5 class="footer-widget__title text-white">{{ __('Useful Link') }}</h5>
          <ul class="footer-lists">
            <li class="footer-lists__item">
              <a href="{{ url('/') }}" class="footer-lists__link">{{ __('Home') }} </a>
            </li>
            <li class="footer-lists__item">
              <a href="{{ route('products') }}" class="footer-lists__link">{{ __('Product Details') }}</a>
            </li>
            <li class="footer-lists__item">
              <a href="{{ route('contact') }}" class="footer-lists__link">{{ __('Contact') }}</a>
            </li>

            @if(!Auth::check())
              <li class="footer-lists__item">
                <a href="{{ route('login') }}" class="footer-lists__link">{{ __('Login') }}</a>
              </li>
              <li class="footer-lists__item">
                <a href="{{ route('register') }}" class="footer-lists__link">{{ __('Register') }}</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-xs-6 ps-xl-5">
        <div class="footer-widget">
          <h5 class="footer-widget__title text-white">{{ __('Quick Links') }}</h5>
          <ul class="footer-lists">
            @foreach ($customPages as $page)
              <li class="footer-lists__item">
                <a href="{{ route('page', $page->slug) }}" class="footer-lists__link">{{ $page->name }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6">
        <div class="footer_widget_count">
          <ul>
            @if($footerSection?->items_sold)
              <li>
                <h4>{{ $footerSection?->items_sold }}</h4>
                <p>{{ __('items sold') }}</p>
              </li>
            @endif
            @if($footerSection?->community_earnings)
              <li>
                <h4>{{ $footerSection?->community_earnings }}</h4>
                <p>{{ __('community earnings') }}</p>
              </li>
            @endif
          </ul>
          <div class="img">
            <img
              src="{{ asset($footerSection?->gateway_image) }}"
              alt="Payment" class="img-fluid w-100"
            >
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- bottom Footer -->
  <div class="bottom-footer">
    <div class="container container-two">
      <div class="bottom-footer__inner text-center">
        <p class="bottom-footer__text font-14"> {{ $footerSection?->copyright }}</p>
      </div>
    </div>
  </div>
</footer>

@push('scripts')
  <script>
    'use strict';

    // Notyf init
    var notyf = new Notyf();

    $(function() {
      $('.subscription_form').on('submit', function(e) {
        e.preventDefault();

        // récupérer toutes les valeurs du formulaire
        let formData = $(this).serialize();

        // les tansmettre via requête Ajax
        $.ajax({
          method: 'POST',
          url: route('newsletter.store'),
          data: formData,
          beforeSend: function() {
            $('.subscribe-btn').text('Loading...')
          },
          success: function(response) {
            if(response.status == 'success'){
              $('.subscribe-btn').text('Subscribe')
              $('.subscription_form').get(0).reset()
              notyf.success(response.message)
            }
          },
          error: function(xhr, status, error) {
            let errorMessage = xhr.responseJSON.message
            notyf.error(errorMessage)

            $('.subscribe-btn').text('Subscribe')
          }
        })
      })
    })
  </script>
@endpush