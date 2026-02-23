@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Approved Items') }}</h3>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Details</th>
                      <th>Category</th>
                      <th>Publish Date</th>
                      <th>Status</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($items as $item)
                      <tr>
                        <td>#{{ $item->id }}</td>
                        <td>
                          <div class="d-flex">
                            <div class="me-3">
                              @if($item->preview_type == 'image')
                                <img style="width: 50px; height: 50px; object-fit: cover;" src="{{ asset($item->preview_image) }}" alt="">
                              @elseif($item->preview_type == 'video')
                                <img style="width: 50px; height: 50px; object-fit: cover;" src="{{ asset('defaults/video.webp') }}" alt="">
                              @elseif($item->preview_type == 'audio')
                                <img style="width: 50px; height: 50px; object-fit: cover;" src="{{ asset('defaults/audio.webp') }}" alt="">
                              @endif
                            </div>
                            <div>
                              <div>
                                <a href="#" class="text-reset">
                                  <b>{{ $item->name }}</b>
                                </a>
                              </div>
                              <div>
                                <span>Author:</span> <span class="text-primary">{{ $item->author->name }}</span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <span class="text-primary">{{ $item->category->name }}</span>
                            <span class="ms-2 me-2">/</span>
                            <span class="text-primary">{{ $item->subCategory->name }}</span>
                          </div>
                        </td>
                        <td>
                          {{ formatDate($item->updated_at) }}
                        </td>
                        <td>
                          <div class="badge bg-success text-white">{{ $item->status }}</div>
                        </td>
                        <td class="text-end">
                          <a href="{{ route('admin.item-reviews.show', $item->id) }}" class="text-primary"><i class="ti ti-eye"></i></a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center"></td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
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