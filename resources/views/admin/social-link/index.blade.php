@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Social Links') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary btn-3">
                <i class="ti ti-plus me-1"></i>
                {{ __('Add new') }}
              </a>
            </div>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>Icon</th>
                      <th>URL</th>
                      <th class="w-8"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($socialLinks as $socialLink)
                    <tr>
                      <td>
                        <i class="{{ $socialLink->icon }}" style="font-size: 30px !important"></i>
                      </td>
                      <td>
                        {{ $socialLink->url }}
                      </td>
                      <td class="text-end">
                        <a href="{{ route('admin.social-links.edit', $socialLink->id) }}" class="text-primary">
                          <i class="ti ti-edit"></i>
                        </a>
                        <a class="delete-item text-danger ms-2" href="{{ route('admin.social-links.destroy', $socialLink->id) }}">
                          <i class="ti ti-trash"></i>
                        </a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="3" class="text-center text-secondary">
                        {{ __('No social links found') }}
                      </td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection