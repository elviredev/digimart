@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('All Sub Categories') }}</h3>
            <div class="card-actions">
              <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary btn-3">
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
                      <th>{{ __('Sub Category Name') }}</th>
                      <th>{{ __('Parent Category') }}</th>
                      <th>{{ __('Date') }}</th>
                      <th class="w-8"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($subCategories as $subCategory)
                      <tr>
                        <td>{{ $subCategory->name }}</td>

                        <td>{{ $subCategory->category->name }}</td>

                        <td>{{ formatDate($subCategory->created_at) }}</td>

                        <td class="text-end">
                          <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}" class="text-primary">
                            <i class="ti ti-edit"></i>
                          </a>
                          <a class="delete-item text-danger ms-2" href="{{ route('admin.sub-categories.destroy', $subCategory->id) }}">
                            <i class="ti ti-trash"></i>
                          </a>
                        </td>
                      </tr>
                    @empty
                      <td colspan="5" class="text-center text-secondary">{{ __('No sub categories found') }}</td>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="card-footer text-end">
            {{ $subCategories->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection