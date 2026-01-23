@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Update Sub Category') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.sub-categories.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row">

                <div class="col-md-12">
                  <x-admin.input-select class="select_2" name="category" :label="__('Parent Category')" >
                    @foreach($categories as $category)
                      <option
                        value="{{ $category->id }}"
                        @selected($subCategory->category_id == $category->id)
                      >
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </x-admin.input-select>
                </div>

                <div class="col-md-12">
                  <x-admin.input-text
                    name="name"
                    :label="__('Sub Category Name')"
                  :value="$subCategory->name"
                  />
                </div>

              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update Sub Category')" onclick="$('form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

