<section class="top-performance overflow-hidden padding-y-120 position-relative z-index-1">
  <div class="container container-two">
    <div class="row gy-4 align-items-center flex-wrap-reverse">
      <div class="col-lg-5">
        <div class="section-content">
          <div class="section-heading style-left">
            <h3 class="section-heading__title">{{ $counterSection?->title }}</h3>
            <p class="section-heading__desc font-18 w-sm">
              {{ $counterSection?->subtitle }}
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 pe-lg-5">
        <div class="position-relative">
          <div class="performance-content">
            <div class="performance-content__item">
              <span class="performance-content__text font-18">
                {{ $counterSection?->label_one }}
              </span>
              <h4 class="performance-content__count">
                {{ $counterSection?->counter_one }}+
              </h4>
            </div>
            <div class="performance-content__item">
              <span class="performance-content__text font-18">
                {{ $counterSection?->label_two }}
              </span>
              <h4 class="performance-content__count">
                {{ $counterSection?->counter_two }}+
              </h4>
            </div>
            <div class="performance-content__item">
              <span class="performance-content__text font-18">
                {{ $counterSection?->label_three }}
              </span>
              <h4 class="performance-content__count">
                {{ $counterSection?->counter_three }}+
              </h4>
            </div>
            <div class="performance-content__item">
              <span class="performance-content__text font-18">
                {{ $counterSection?->label_four }}
              </span>
              <h4 class="performance-content__count">
                {{ $counterSection?->counter_four }}+
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>