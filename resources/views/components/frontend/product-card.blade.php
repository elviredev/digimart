<div class="col-lg-6 col-xl-4 col-sm-6">
  <div class="product-item {{ $product->preview_type == 'video' ? 'product-video' : '' }}">
    <div class="product-item__thumb d-flex">
      @if($product->preview_type == 'image')
        <a href="{{ route('products.show', $product->slug) }}" class="link w-100">
          <img
          src="{{ asset($product->preview_image) }}"
          alt="product image"
          class="cover-img"
          >
        </a>
      @elseif($product->preview_type == 'video')
        <a href="{{ route('products.show', $product->slug) }}" class="link w-100">
          <video class="player" playsinline controls data-poster="">
            <source src="{{ asset($product->preview_video) }}" type="video/mp4" />
          </video>
        </a>
      @elseif($product->preview_type == 'audio')
        <audio class="audio-player" controls>
          <source src="{{ asset($product->preview_audio) }}" type="audio/mp3" />
        </audio>
      @endif
{{--      <button type="button" class="product-item__wishlist">--}}
{{--        <i class="fas fa-heart"></i>--}}
{{--      </button>--}}
    </div>
    <div class="product-item__content">
      <div class="product-item__bottom flx-between gap-2">
        <div
        class="d-flex flex-wrap justify-content-between align-items-center w-100">

          <div class="d-flex align-items-center gap-1">
            <ul class="star-rating">
              @for ($i = 1; $i <= 5; $i++)
                @if(round($product->reviews_avg_stars) >= $i)
                  <li class="star-rating__item font-11">
                    <i class="fas fa-star"></i>
                  </li>
                @else
                  <li class="star-rating__item font-11">
                    <i class="fas fa-star text-muted"></i>
                  </li>
                @endif
              @endfor
            </ul>
            <span class="star-rating__text text-heading fw-500 font-14">
              ({{ $product->reviews_count }})
            </span>
          </div>
          <span class="product-item__sales font-14">
            <i class="ti ti-shopping-bag"></i>
            {{ $product->sales_count }}
          </span>
        </div>
      </div>
      <h6 class="product-item__title">
        <a href="{{ route('products.show', $product->slug) }}" class="link">
          {{ $product->name }}
        </a>
      </h6>
      <div class="product-item__info flx-between gap-2">
        <span class="product-item__author">
          {{ __('by') }}
          <a href="{{ route('products.show', $product->slug) }}" class="link hover-text-decoration-underline">
            {{ $product->author->name }}
          </a>
        </span>
        <div class="flx-align gap-2">
          @if($product->discount_price > 0)
            <h6 class="product-item__price mb-0">${{ $product->discount_price }}</h6>
            <span class="product-item__prevPrice text-decoration-line-through">
              ${{ $product->price }}
            </span>
          @else
            <h6 class="product-item__price mb-0">${{ $product->price }}</h6>
          @endif
        </div>
      </div>
      <div class="product_item_footer">
        @if(in_array($product->id, session('purchase_ids', [])))
          <a class="product_cart bg-warning text-white" href="javascript:;">
            <i class="ti ti-shopping-cart-plus me-2"></i>
            <span id="cart-btn-{{ $product->id }}">{{ __('Already purchased') }}</span>
          </a>
        @else
          <a class="product_cart add-cart" data-id="{{ $product->id }}" href="javascript:;">
            <i class="ti ti-shopping-cart-plus me-2"></i>
            <span id="cart-btn-{{ $product->id }}">{{ __('Add to cart') }}</span>
          </a>
        @endif
      </div>
    </div>
  </div>
</div>