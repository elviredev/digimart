<section class="hero section-bg z-index-1">
  <img src="{{ asset('assets/frontend/images/gradients/banner-gradient.png') }}" alt="" class="bg--gradient white-version">

  <div class="container container-two">
    <div class="row gy-sm-5 gy-4 align-items-center">
      <div class="col-xl-6 col-lg-9 col-12">
        <div class="hero-inner position-relative">
          <div>
            <h1 class="hero-inner__title">{{ $heroSection?->title }}</h1>
            <p class="hero-inner__desc font-18">{{ $heroSection?->subtitle }}</p>

            <div class="position-relative">
              <div class="search-box">
                <!-- Search Form -->
                <form action="{{ route('products') }}" method="GET">
                  <input
                    type="text"
                    class="common-input common-input--lg shadow-sm auto-suggestion-input"
                    placeholder="Search theme, plugins & more..."
                    name="search"
                  >
                  <button type="submit" class="btn btn-main btn-icon icon border-0">
                    <img src="{{ asset('assets/frontend/images/icons/search.svg') }}" alt="">
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Images Carousel -->
      @php
        $featuredItemsOne = App\Models\Item::select(['id', 'name', 'slug', 'preview_type', 'preview_image', 'preview_video', 'preview_audio'])
          ->whereIn('id', $heroSection?->featured_items_one ?? [])
          ->get();
        $featuredItemsTwo = App\Models\Item::select(['id', 'name', 'slug', 'preview_type', 'preview_image', 'preview_video', 'preview_audio'])
          ->whereIn('id', $heroSection?->featured_items_two ?? [])
          ->get();
      @endphp
      <div class="col-xl-3 col-12 col-md-6 col-lg-4">
        <div class="hero-thumb">
          <ul class="direction_right">
            @foreach ($featuredItemsOne as $item)
              @php
                if ($item->preview_type == 'image'){
                  $image = asset($item->preview_image);
                } elseif ($item->preview_type == 'video'){
                  $image = asset('defaults/video.webp');
                } elseif ($item->preview_type == 'audio'){
                  $image = asset('defaults/audio.webp');
                }
              @endphp
              <li>
                <a href="{{ route('products.show', $item->slug) }}"><img src="{{ $image }}" alt="" /></a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-12 col-md-6 col-lg-4 pt-5 sm_margin">
        <div class="hero-thumb">
          <ul class="direction_left">
            @foreach ($featuredItemsTwo as $item)
              @php
                if ($item->preview_type == 'image'){
                  $image = asset($item->preview_image);
                } elseif ($item->preview_type == 'video'){
                  $image = asset('defaults/video.webp');
                } elseif ($item->preview_type == 'audio'){
                  $image = asset('defaults/audio.webp');
                }
              @endphp
              <li>
                <a href="{{ route('products.show', $item->slug) }}"><img src="{{ $image }}" alt="" /></a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>