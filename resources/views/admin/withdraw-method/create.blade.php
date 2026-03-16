@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Create Withdrawal Method') }}</h3>
            <div class="card-actions">
              <x-admin.back-button href="{{ route('admin.withdrawal-methods.index') }}" />
            </div>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.withdrawal-methods.store') }}" method="POST" class="x-form" >
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <x-admin.input-text name="name" :label="__('Name')" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="minimum_amount" :label="__('Minimum Amount')" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="maximum_amount" :label="__('Maximum Amount')" />
                </div>
                <div class="col-md-12">
                  <x-admin.input-textarea name="description" :label="__('Description')" />
                </div>
                <div class="col-md-12">
                  <x-admin.input-select name="status" :label="__('Status')" >
                    <option value="1">{{ __('Active') }}</option>
                    <option value="0">{{ __('Inactive') }}</option>
                  </x-admin.input-select>
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Create')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection