<section class="top-author padding-y-120 position-relative z-index-1">
  <div class="container container-two">
    <div class="row gy-4 align-items-center justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1">
        <div class="position-relative">
          <div class="row gy-4">
            @foreach($featuredAuthorProducts as $product)
            <div class="col-sm-6">
              <div class="product-item box-shadow">
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
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-5 order-lg-2">
        <div class="section-content">
          <div class="section-heading style-left">
            <h3 class="section-heading__title">
              {{ $featuredAuthorSection?->title }}
            </h3>
            <p class="section-heading__desc font-18 w-sm">
              {{ $featuredAuthorSection?->subtitle }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>