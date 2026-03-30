<section class="seller padding-y-120">
  <div class="container container-two">
    <div class="row gy-4">
      <div class="col-lg-6">
        <div
        class="seller-item position-relative z-index-1"
        style="background: url({{ asset($bannerSection?->background_image_one) }});">
          <h3 class="seller-item__title">
            {{ $bannerSection?->banner_title_one }}
          </h3>
          <p class="seller-item__desc fw-500 text-heading">
            {{ $bannerSection?->banner_subtitle_one }}
          </p>
          @if ($bannerSection?->button_text_one)
            <a href="{{ $bannerSection?->button_url_one }}" class="btn btn-static-outline-black  fw-600">
              {{ $bannerSection?->button_text_one }}
            </a>
          @endif
        </div>
      </div>
      <div class="col-lg-6">
        <div
        class="seller-item bg-two position-relative z-index-1"
        style="background: url({{ asset($bannerSection?->background_image_two) }});">
          <h3 class="seller-item__title">
            {{ $bannerSection?->banner_title_two }}
          </h3>
          <p class="seller-item__desc fw-500 text-heading">
            {{ $bannerSection?->banner_subtitle_two }}
          </p>
          @if ($bannerSection?->button_text_two)
            <a href="{{ $bannerSection?->button_url_two }}" class="btn btn-static-outline-black  fw-600">
              {{ $bannerSection?->button_text_two }}
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>