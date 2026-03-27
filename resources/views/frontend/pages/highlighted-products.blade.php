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
                  <a href="{{ route('home') }}"
                  class="breadcrumb-list__link text-body hover-text-main">{{ __('Home') }}</a>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__icon font-10">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__text">{{ __('Highlighted Products') }}</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">
                {{ __('Highlighted Products') }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- ======================== All Product Section Start ====================== -->
  <section class="all-product padding-y-120">
    <div class="container container-two">
      <div class="row d-flex justify-content-center">
        <!-- Partie Products -->
        <div class="col-xl-9 col-lg-8">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-product" role="tabpanel"
            aria-labelledby="pills-product-tab" tabindex="0">
              <div class="row gy-4">
                @forelse($highlightedProducts as $product)
                  <x-frontend.product-card :product="$product" />
                @empty
                  <p class="text-center">No data found!</p>
                @endforelse
              </div>
              <!-- Pagination Start -->
                <x-frontend.pagination :paginator="$highlightedProducts" />
              <!-- Pagination End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== All Product Section End ====================== -->
@endsection

@push('scripts')
  <script>
    const player = new Plyr('.player', {
      controls: []
    });

    const audio = new Plyr('.audio-player', {
      controls: ['play', 'progress', 'mute', 'current-time']
    });

    $(function() {
      $('.product-video').on('mouseover', function() {
        player.muted = true
        player.play()
      })

      $('.product-video').on('mouseout', function() {
        player.pause()
      })
    })
  </script>
@endpush

