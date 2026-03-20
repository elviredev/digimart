@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Review List') }}</h5>
        <p>{{ __('All reviews.') }}</p>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">{{ __('Item') }}</th>
          <th class="p_date">{{ __('Rating') }}</th>
          <th class="details">{{ __('Review') }}</th>
          <th class="p_date">{{ __('Date') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reviews as $review)
          <tr>
            <td class="details">
              <div class="d-flex align-items-center">
                @if($review->item->preview_type == 'image')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset($review->item->preview_image) }}" alt="">
                @elseif($review->item->preview_type == 'video')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset('defaults/video.webp') }}" alt="">
                @elseif($review->item->preview_type == 'audio')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset('defaults/audio.webp') }}" alt="">
                @endif

                <div class="ms-3">
                  <h6>{{ $review->item->name }}</h6>
                  <div class="d-flex">
                    <span class="text-primary">{{ $review->item->category->name }}</span>
                    <span class="ms-2 me-2">/</span>
                    <span class="text-primary">{{ $review->item->subCategory->name }}</span>
                  </div>
                  <div><small>By {{ $review->item->author->name }}</small></div>
                </div>
              </div>
            </td>
            <td>
              @for($i = 1; $i <= $review->stars; $i++)
                <i class="fa fa-star text-warning"></i>
              @endfor
              @for($i = $review->stars + 1; $i <= 5; $i++)
                <i class="fas fa-star text-secondary"></i>
              @endfor
            </td>
            <td>{{ $review->body }}</td>
            <td class="text-start">{{ formatDate($review->created_at) }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">No reviews found.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
    <div>
      {{ $reviews->links() }}
    </div>

  </div>
@endsection

