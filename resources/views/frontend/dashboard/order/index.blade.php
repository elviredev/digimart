@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Purchases') }}</h5>
        <p>{{ __('Your purchase items.') }}</p>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">{{ __('ID') }}</th>
          <th class="details">{{ __('Details') }}</th>
          <th class="p_date">{{ __('Purchase Date') }}</th>
          <th class="action">{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($purchases as $purchase)
          <tr>
            <td>#{{ $purchase->id }}</td>
            <td>
              <div class="d-flex align-items-center">
                <div>
                  @if($purchase->item->preview_type == 'image')
                    <a href="javascript:;" class="link">
                      <img src="{{ asset($purchase->item->preview_image) }}" alt=""
                      class="cover-img-item">
                    </a>
                  @elseif($purchase->item->preview_type == 'video')
                    <a href="javascript:;" class="link">
                      <img src="{{ asset('defaults/video.webp') }}" alt=""
                      class="cover-img-item" >
                    </a>
                  @elseif($purchase->item->preview_type == 'audio')
                    <a href="javascript:;" class="link">
                      <img src="{{ asset('defaults/audio.webp') }}" alt=""
                      class="cover-img-item">
                    </a>
                  @endif
                </div>
                <div class="ms-3 text-start">
                  <h6>{{ $purchase->item->name }}</h6>
                  <span>{{ $purchase->item->category->name }} / {{ $purchase->item->subCategory->name }}</span>
                  @for($i = 0; $i < 5; $i++)
                      <span class="d-inline-block">
                        <i class="fa fa-star"></i>
                      </span>
                  @endfor
                  <p class="font-13">
                    <a href="">{{ __('(write a review)') }}</a>
                  </p>
                </div>
              </div>
            </td>
            <td>{{ formatDate($purchase->created_at) }}</td>
            <td class="text-center">
              <a class="btn btn-sm btn-primary " href="{{ route('orders.show', $purchase->id) }}">
                <i class="ti ti-eye font-4"></i>
              </a>
              <a class="btn btn-sm btn-success" href="{{ route('order.download-item', $purchase->item->id) }}">
                <i class="ti ti-download font-4"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">No data found.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
    <div>
      {{ $purchases->links() }}
    </div>
  </div>
@endsection

