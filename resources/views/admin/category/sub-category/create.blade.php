@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Create Category') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.sub-categories.index') }}"  />
            </div>
          </div>

          <div class="card-body">
            <form class="x-form" action="{{ route('admin.sub-categories.store') }}" method="POST">
              @csrf

              <div class="row">

                <div class="col-md-12">
                  <x-admin.input-select class="select_2" name="category" :label="__('Parent Category')" >
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </x-admin.input-select>
                </div>

                <div class="col-md-12">
                  <x-admin.input-text name="name" :label="__('Sub Category Name')" />
                </div>

              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Create Sub Category')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

