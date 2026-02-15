@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Update Item') }}</h5>
        <p>{{ __('Manage your item.') }}</p>
      </div>
      <div>
        <a href="{{ route('user.items.index') }}" class="btn btn-dark">
          {{ __('Back') }}
        </a>
      </div>
    </div>
  </div>

  <!-- Formulaire -->
  <form action="{{ route('user.items.changelog.store', $item->id) }}" method="POST" enctype="multipart/form-data" id="product_form">
    @csrf

    <ul class="nav nav-pills mt-4">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('user.items.edit', $item->id) }}">
          Edit Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('user.items.changelog', $item->id) }}">Changelogs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.items.history', $item->id) }}">History</a>
      </li>
    </ul>

    <div class="row">
      <div class="col-md-7">
        @if($item->status == 'approved')
          <div class="wsus__dash_order_table mt-3">
            <div>
              <h6>{{ __('Add New Log') }}</h6>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <x-frontend.input-text name="version" :label="__('Version')" :required="true" />
              </div>

              <div class="col-md-12">
                <x-frontend.text-area name="description" :label="__('Description')" :required="true" />
              </div>
            </div>
          </div>
        @else
          <div class="wsus__dash_order_table mt-3 text-center">
            <p>{{ __('This item is not approved yet.') }}</p>
          </div>
        @endif
      </div>

      <div class="col-md-5">
        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6></h6>
          </div>

          <div class="row">
            <div class="col-6">
              <b>{{ __('ID') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>#{{ $item->id }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Name') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>{{ $item->name }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Category') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>{{ $item->category->name }} / {{ $item->subCategory->name }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Status') }}</b>
            </div>

            <div class="col-6 text-end">
              @if ($item->status == 'approved')
                <span class="badge bg-success">{{ __('Approved') }}</span>
              @elseif ($item->status == 'pending')
                <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
              @elseif ($item->status == 'soft_reject')
                <span class="badge bg-secondary">{{ __('Soft Reject') }}</span>
              @elseif ($item->status == 'hard_reject')
                <span class="badge bg-secondary">{{ __('Hard Reject') }}</span>
              @elseif ($item->status == 'resubmitted')
                <span class="badge bg-primary">{{ __('Resubmitted') }}</span>
              @endif
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Publish date') }}</b>
            </div>

            <div class="col-6 text-end mb-4">
              <span>{{ formatDate($item->created_at) }}</span>
            </div>


            <div class="col-12">
              <a href="{{ route('user.items.download', $item->id) }}" class="btn btn-sm btn-primary w-100">{{ __('Download') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if($item->status == 'approved')
      <div class="wsus__dash_order_table mt-3">
      <div class="row">
        <div class="col-md-12" >
          <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
      </div>
    </div>
    @endif
  </form>
@endsection























