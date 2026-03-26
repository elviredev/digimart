<section class="popular padding-y-120 overflow-hidden">
  <div class="container container-two">
    <div class="section-heading style-left mb-0">
      <h5 class="section-heading__title">{{ __('Featured Categories') }}</h5>
      <a href="{{ route('products') }}"
      class="font-18 fw-600 text-heading hover-text-main text-decoration-underline font-heading"
      >
        Explore More
      </a>
    </div>
    <div class="row justify-content-center">
      @forelse ($featuredCategories as $category)
      <div class="col-auto">
        <a href="{{ route('products', ['category' => $category->slug]) }}" class="popular-item w-100">
          <span class="popular-item__icon">
              <i class="{{ $category->icon }}"></i>
          </span>
          <h6 class="popular-item__title font-18">{{ $category->name }}</h6>
          <span class="popular-item__qty text-body">{{ $category->items_count }}</span>
        </a>
      </div>
      @empty
        <div class="text-center">{{ __('No category found') }}</div>
      @endforelse
    </div>
  </div>
</section>