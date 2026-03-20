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
                  <a href="{{ route('products') }}"
                  class="breadcrumb-list__link text-body hover-text-main">
                    {{ __('Products') }}
                  </a>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__icon font-10">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__text">
                    {{ __('Product details') }}
                  </span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">
                {{ __('Product details') }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- ======================= Product Details Section Start ==================== -->
  <section class="wsus__product_details padding-y-120">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 col-lg-7 ">

          @if($product->preview_type == 'image')
            <div class="wsus__product_details_img p-0">
              <img
                src="{{ asset($product->preview_image) }}"
                alt="product image" class="img-fluid w-100"
              >
            </div>
          @elseif($product->preview_type == 'video')
            <div class="wsus__product_details_img p-0">
              <video id="player" playsinline controls data-poster="">
                <source src="{{ asset($product->preview_video) }}" type="video/mp4" />
              </video>
            </div>
          @elseif($product->preview_type == 'audio')
            <div class="wsus__product_details_img p-0" style="height: 82px;">
              <audio id="player" controls>
                <source src="{{ asset($product->preview_audio) }}" type="audio/mp3" />
              </audio>
            </div>
          @endif

          <div class="wsus__product_details_text">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                aria-selected="true">
                  <i class="ti ti-layers-intersect"></i> {{ __('Description') }}
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                data-bs-target="#pills-profile" type="button" role="tab"
                aria-controls="pills-profile" aria-selected="false">
                  <i class="far fa-comments"></i>
                  {{ __('Comments') }} (43)
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                data-bs-target="#pills-contact" type="button" role="tab"
                aria-controls="pills-contact" aria-selected="false">
                  <i class="far fa-star"></i>
                  {{ __('Review') }}
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
              aria-labelledby="pills-home-tab" tabindex="0">
                <div class="wsus__pro_description">
                  <h4>{{ __('Items Description Details') }}</h4>
                  {!! $product->description !!}
                </div>

              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel"
              aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="wsus__pro_det_comment">
                  <h4>{{ __('Comments All') }}</h4>
                  @forelse ($comments as $comment)
                  <div class="wsus__single_comment">
                    <div class="comment_footer d-flex flex-wrap">
                      <div class="img">
                        <img
                          src="{{ asset($comment->user->avatar) }}"
                          alt="user avatar"
                          class="img-fluid w-100"
                        >
                      </div>
                      <div class="text">
                        <h3>{{ $comment->user->name }}</h3>
                        <p>{{ __('user') }}</p>
                      </div>
                    </div>
                    <p class="comment_des">{{ $comment->body }}</p>
                    <p class="comment_date">
                      <span class="date">
                        <i class="far fa-calendar-alt"></i>
                        {{ formatDate($comment->created_at) }}
                      </span>
                    </p>
                  </div>
                  @empty
                    <div class="text-center">{{ __('There is no comment.') }}</div>
                  @endforelse
                </div>

                <nav aria-label="Page navigation example">
                  <!-- <ul class="pagination common-pagination mt-0">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                      <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                        <span class="icon line-height-1 font-20"><i
                          class="las la-arrow-right"></i></span>
                      </a>
                    </li>
                  </ul>-->
                  {{ $comments->links() }}
                </nav>

                @if(auth()->check())
                  <form action="{{ route('item.comment.store', $product->id) }}" method="POST" class="wsus__comment_input_area">
                  @csrf

                  <h3>{{ __('Leave a Comment') }}</h3>
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="wsus__comment_single_input">
                        <fieldset>
                          <legend>{{ __('comment*') }}</legend>
                          <textarea name="comment" rows="7" placeholder="Type here.."></textarea>
                        </fieldset>
                        @if($errors->has('comment'))
                          <span class="text-danger">{{ $errors->first('comment') }}</span>
                        @endif
                      </div>
                      <button class="btn btn-main btn-lg" type="submit">{{ __('Submit Comment') }}</button>
                    </div>
                  </div>
                </form>
                @else
                  <div class="wsus__comment_input_area">
                    <div class="alert alert-info text-center">{{ __('You need to login to add a comment.') }}</div>
                  </div>
                @endif
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel"
              aria-labelledby="pills-contact-tab" tabindex="0">
                <div class="wsus__pro_det_review">
                  <h3>{{ __('Reviews') }}</h3>
                  @forelse ($reviews as $review)
                    <div class="wsus__single_comment">
                    <div class="comment_footer d-flex flex-wrap">
                      <div class="img">
                        <img
                        src="{{ asset($review->user->avatar) }}"
                        alt="user avatar"
                        class="img-fluid w-100"
                        >
                      </div>
                      <div class="text">
                        <h3>{{ $review->user->name }}
                          <span>
                            {{-- Étoiles pleines --}}
                            @for ($i = 1; $i <= $review->stars; $i++)
                              <i class="fas fa-star"></i>
                            @endfor
                            {{-- Étoiles vides --}}
                            @for($i = $review->stars + 1; $i <= 5; $i++)
                                <i class="fas fa-star text-secondary"></i>
                            @endfor
                          </span>
                        </h3>
                        <p>{{ __('user') }}</p>
                      </div>
                    </div>
                    <p class="comment_des">{{ $review->body }}</p>
                    <p class="comment_date">
                      <span class="date">
                        <i class="far fa-calendar-alt"></i>
                        {{ formatDate($review->created_at) }}
                      </span>
                    </p>
                  </div>
                  @empty
                    <div class="text-center">{{ __('There is no review.') }}</div>
                  @endforelse
                </div>

                <nav aria-label="Page navigation example">
                  {{--}}<ul class="pagination common-pagination mt-0">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                      <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                        <span class="icon line-height-1 font-20"><i
                          class="las la-arrow-right"></i></span>
                      </a>
                    </li>
                  </ul>--}}

                  {{ $reviews->links() }}
                </nav>

                @if(auth()->check())
                  <form action="{{ route('item.review.store', $product->id) }}" method="POST" class="wsus__comment_input_area">
                  @csrf

                  <h3>{{ __('Write Your Reviews') }}</h3>
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="wsus__comment_single_input">
                        <legend>{{ __('rating') }}*</legend>
                        <select name="rating" id="" class="form-select">
                          @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                        @if($errors->has('rating'))
                          <span class="text-danger">{{ $errors->first('rating') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-xl-12">
                      <div class="wsus__comment_single_input">
                        <fieldset>
                          <legend>{{ __('review') }}*</legend>
                          <textarea name="review" rows="7" placeholder="Type here.."></textarea>
                        </fieldset>
                        @if($errors->has('review'))
                          <span class="text-danger">{{ $errors->first('review') }}</span>
                        @endif
                      </div>
                      <button class="btn btn-main btn-lg" type="submit">{{ __('Submit Review') }}</button>
                    </div>
                  </div>
                </form>
                @else
                  <div class="wsus__comment_input_area">
                    <div class="alert alert-info text-center">{{ __('You need to login to add a review.') }}</div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="wsus__sidebar pl_30 xs_pl_0" id="sticky_sidebar">
            <div class="wsus__sidebar_licence">
              <h2><span>$</span> 56</h2>
              <ul class="feature">
                <li>{{ __('Life time access') }}</li>
                <li>{{ __('Quality checked by') }} {{ config('settings.site_name') }}</li>
                @if ($product->is_supported)
                  <li>{{ __('Support available') }}</li>
                @endif
              </ul>
              <ul class="button_area d-flex flex-wrap">
                <li><a class="live" href="#">Live Proview</a></li>
                <li><a class="add_cart" href="#">add to cart</a></li>
              </ul>
              <ul class="sell_rating mt_20 d-flex flex-wrap justify-content-between">
                <li><i class="fas fa-shopping-basket"></i> 8541</li>
                <li><i class="far fa-comments"></i> 45</li>
                <li><i class="far fa-star"></i> 29</li>
              </ul>
            </div>

            <div class="wsus__sidebar_author_info mt-4">
              <h3>Author Profile</h3>
              <div class="wsus__sidebar_author_text">
                <div class="img">
                  <img src="{{ asset($product->author->avatar) }}" alt="author" class="img-fluid w-100">
                </div>
                <div class="text">
                  <h4>{{ $product->author->name }}</h4>
                  <p>Signup- {{ formatDate($product->author->created_at) }}</p>
                </div>
              </div>
              <ul class="d-flex flex-wrap justify-content-center">
                <li>
                  <h4>{{ $product->author->products()->count() }}</h4>
                  <p>products</p>
                </li>
                <li>
                  <h4>255</h4>
                  <p>sales</p>
                </li>
              </ul>
              <button class="btn btn-main btn-lg"><i class="fal fa-stars"></i> Level 3</button>
            </div>

            <div class="wsus__sidebar_pro_info mt-4">
              <h3>product Info</h3>
              <ul>
                <li><span>Released</span> {{ formatDate($product->created_at) }}</li>
                <li><span>Updated</span> {{ formatDate($product->updated_at) }}</li>

                @if($product->is_main_file_external == 1)
                  <li><span>Source </span> URL</li>
                @else
                  @php
                    $filePath = storage_path('app/private/' . $product->main_file);
                  @endphp

                  @if($product->main_file && File::exists($filePath))
                    <li>
                      <span>File Type</span>
                      {{ pathinfo($product->main_file, PATHINFO_EXTENSION) }}
                    </li>
                  @endif
                @endif

                @if($product->is_main_file_external == 0)
                  @php $size = getFileSize($product->main_file); @endphp
                  @if($size)
                    <li><span>File Size</span> {{ $size }}</li>
                  @endif
                @endif
                <li><span>Tags</span>
                  <p>
                    @foreach($product->tags as $tag)
                      <a href="#">{{ $tag }} {{ $loop->last ? '' : ',' }}</a>
                    @endforeach
                  </p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================= Product Details Section End ==================== -->
@endsection

@push('scripts')
  <script>
    const player = new Plyr('#player');
  </script>
@endpush