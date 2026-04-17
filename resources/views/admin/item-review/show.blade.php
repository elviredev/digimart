@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Item Details') }}</h3>
            <div class="card-actions">
              <x-admin.back-button :href="route('admin.item-reviews.pending.index')" />
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Item Details') }}</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('History') }}</button>
                  </li>
                  @if($item->status == 'pending' || $item->status == 'resubmitted' || admin()->hasRole('super admin'))
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('Status') }}</button>
                    </li>
                  @endif
                </ul>

                <div class="tab-content" id="pills-tabContent">
                  {{-- Partie Item Details --}}
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="accordion" id="accordion-example">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-1">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                            {{ __('Preview') }}
                          </button>
                        </h2>
                        <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                          <div class="accordion-body pt-0">
                            @if($item->preview_type == 'image')
                              <img style="max-height: 500px; width: 100%; object-fit: cover;" src="{{ asset($item->preview_image) }}" alt="" class="img-fluid">
                            @elseif($item->preview_type == 'video')
                              <iframe src="{{ asset($item->preview_video) }}" frameborder="0"></iframe>
                            @elseif($item->preview_type == 'audio')
                              <audio src="{{ $item->preview_audio }}" controls></audio>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-2">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">
                            {{ __('Screenshots') }}
                          </button>
                        </h2>
                        <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                          <div class="accordion-body pt-0">
                            <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                @forelse($item?->screenshots ?? [] as $screenshot)
                                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block w-100" alt="" src="{{ asset($screenshot) }}">
                                  </div>
                                @empty
                                  <div>Not image found.</div>
                                @endforelse
                              </div>
                              <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-3">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false">
                            {{ __('Description') }}
                          </button>
                        </h2>
                        <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                          <div class="accordion-body pt-0">
                           {!! $item->description !!}
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-4">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false">
                            {{ __('Support') }}
                          </button>
                        </h2>
                        <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                          <div class="accordion-body pt-0">
                            @if($item->is_supported == 1)
                              <span class="badge bg-success text-white">{{ __('Supported') }}</span>
                            @else
                              <span class="badge bg-danger text-white">{{ __('Not Supported') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-5">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false">
                            {{ __('Price') }}
                          </button>
                        </h2>
                        <div id="collapse-5" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                          <div class="accordion-body pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <x-admin.input-text name="price" label="{{ __('Regular Price') }}" :value="$item->price" disabled />
                              </div>
                              <div class="col-md-6">
                                <x-admin.input-text name="discount_price" label="{{ __('Discount Price') }}" :value="$item->discount_price" disabled />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-6">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false">
                            {{ __('Free Item') }}
                          </button>
                        </h2>
                        <div id="collapse-6" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                          <div class="accordion-body pt-0">
                            @if($item->is_free == 1)
                              <span class="badge bg-success text-white">{{ __('Free item') }}</span>
                            @else
                              <span class="badge bg-danger text-white">{{ __('Not Free') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- Partie History --}}
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @forelse($item->histories as $history)
                      <div class="card mt-3">
                        <div class="card-body">
                          <h4>{{ $history->title }}</h4>
                          <p>{{ $history->body }}</p>
                          <p>{{ __('Status') }} : {{ Str::replace('_', ' ', $history->status) }}</p>
                          <hr>
                          <span>{{ __('Date') }} : {{ formatDate($history->created_at) }}</span>
                        </div>
                      </div>
                    @empty
                      <div class="wsus__dash_order_table mt-3">
                        {{ __('No Data') }}
                      </div>
                    @endforelse
                  </div>

                  {{-- Partie Status --}}
                  @if($item->status == 'pending' || $item->status == 'resubmitted' || admin()->hasRole('super admin'))
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                  <form action="{{ route('admin.item-reviews.status', $item->id) }}" method="POST">
                    @csrf

                    <x-admin.input-select name="status" label="{{ __('Status') }}" id="status" >
                      <option value="soft_rejected" @selected($item->status == 'soft_rejected')>Soft Reject</option>
                      <option value="hard_rejected" @selected($item->status == 'hard_rejected')>Hard Reject</option>
                      <option value="approved" @selected($item->status == 'approved')>Approve</option>
                    </x-admin.input-select>

                    <div class="d-none" id="reason">
                      <x-admin.input-textarea name="reason" label="{{ __('Reason') }}" :value="$item->reject_reason" />
                    </div>

                    <x-admin.submit-button :label="__('Update')" />
                  </form>
                </div>
                  @endif
                </div>
              </div>

              <div class="col-md-4">
                <div class="card mt-3">

                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <b>{{ __('ID') }}</b>
                      </div>

                      <div class="col-8 text-end">
                        <span>#{{ $item->id }}</span>
                      </div>
                      <hr class="mt-2">

                      <div class="col-2">
                        <b>{{ __('Name') }}</b>
                      </div>

                      <div class="col-10 text-end">
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
                          <span class="badge bg-green text-green-fg">{{ __('Approved') }}</span>
                        @elseif ($item->status == 'pending')
                          <span class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                        @elseif ($item->status == 'soft_rejected')
                          <span class="badge bg-cyan text-cyan-fg">{{ __('Soft Reject') }}</span>
                        @elseif ($item->status == 'hard_rejected')
                          <span class="badge bg-red text-red-fg">{{ __('Hard Reject') }}</span>
                        @elseif ($item->status == 'resubmitted')
                          <span class="badge bg-indigo text-indigo-fg">{{ __('Resubmitted') }}</span>
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
                        @if($item->demo_link)
                          <a href="{{ $item->demo_link }}" class="btn btn-yellow w-100 mb-2" target="_blank">{{ __('Demo') }}</a>
                        @endif

                        @if($item->is_main_file_external == 1)
                          <a href="{{ $item->main_file }}" class="btn btn-primary w-100" target="_blank">{{ __('Open Link') }}</a>
                        @else
                          <a href="{{ route('admin.item.download', $item->id) }}" class="btn btn-primary w-100">{{ __('Download') }}</a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card-footer text-end">

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    'use strict'
    $(function() {
      $('#status').on('change', function() {
        let status = $(this).val()
        if (status == 'hard_rejected' || status == 'soft_rejected') {
          $('#reason').removeClass('d-none')
        } else {
          $('#reason').addClass('d-none')
        }
      })
    })
  </script>
@endpush




