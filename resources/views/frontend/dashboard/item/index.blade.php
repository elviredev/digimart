@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>My Items</h5>
        <p>Manage your items.</p>
      </div>
      <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          {{ __('Add Item') }}
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
          <th class="sn">
            Details
          </th>
          <th class="details">
            Price
          </th>
          <th class="p_date">
            Publish Date
          </th>
          <th class="e_date">
            Status
          </th>
          <th class="action">
            action
          </th>
        </tr>
        </thead>
        <tbody>
          @forelse($items as $item)
          <tr>
            <td class="details">
              <div class="d-flex align-items-center">
                @if($item->preview_type == 'image')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset($item->preview_image) }}" alt="">
                @elseif($item->preview_type == 'video')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset('defaults/video.webp') }}" alt="">
                @elseif($item->preview_type == 'audio')
                  <img style="width: 80px; height: 80px; object-fit: cover;" src="{{ asset('defaults/audio.webp') }}" alt="">
                @endif

              <div class="ms-3">
                <h6>{{ $item->name }}</h6>
                <div class="d-flex">
                  <span class="text-primary">{{ $item->category->name }}</span>
                  <span class="ms-2 me-2">/</span>
                  <span class="text-primary">{{ $item->subCategory->name }}</span>
                </div>
              </div>
            </div>
            </td>
            <td class="">
              @if($item->discount_price > 0)
                <div class="d-flex justify-center">
                  <h6 class="text-muted fw-normal"><del>${{ $item->price }}</del></h6>
                  <h6 class="ms-2">${{ $item->discount_price }}</h6>
                </div>
              @else
                <h6>${{ $item->price }}</h6>
              @endif
            </td>
            <td class="p_date">
              <p>{{ formatDate($item->created_at) }}</p>
            </td>
            <td class="text-center">
              @if($item->status == 'pending')
                <div class="badge bg-warning text-dark">{{ __('Pending') }}</div>
              @elseif($item->status == 'resubmitted')
                <div class="badge bg-info text-dark">{{ __('Resubmitted') }}</div>
              @elseif($item->status == 'approved')
                <div class="badge bg-success">{{ __('Approved') }}</div>
              @elseif($item->status == 'soft_rejected')
                <div class="badge bg-secondary">{{ __('Soft Rejected') }}</div>
              @elseif($item->status == 'hard_rejected')
                <div class="badge bg-secondary">{{ __('Hard Rejected') }}</div>
              @endif
            </td>
            <td class="action">
              @if($item->status == 'approved' || $item->status == 'soft_rejected')
                <a class="btn btn-sm btn-primary" href="{{ route('user.items.edit', $item->id) }}"><i class="ti ti-edit"></i></a>
              @else
                <button class="btn btn-sm btn-secondary" disabled><i class="ti ti-edit"></i></button>
              @endif
            </td>
          </tr>
          @empty
            
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <form action="{{ route('user.items.create') }}" method="GET">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <x-frontend.input-select name="category" :label="__('Category')" :required="true" >
              @foreach($categories as $category)
                <option value="{{ $category->slug }}">{{ $category->name }}</option>
              @endforeach
            </x-frontend.input-select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-main btn-md">Next</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

