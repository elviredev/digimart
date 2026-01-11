@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('KYC Settings') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.kyc-settings.update') }}" method="POST">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="mb-1">
                  <label for="" class="form-label">Verification Types</label>
                </div>
                <div class="col-md-4">
                  <x-admin.input-toggle name="nid_verification" label="NID Verification" :checked="$kycSetting->nid_verification" />
                </div>

                <div class="col-md-4">
                  <x-admin.input-toggle name="passport_verification" label="Passport Verification" :checked="$kycSetting->passport_verification" />
                </div>

                <hr class="my-3 text-primary">
                <div class="col-md-12">
                  <x-admin.input-textarea name="instructions" label="Instructions" :value="$kycSetting->instructions" />
                </div>

                <div class="col-md-6">
                  <x-admin.input-select name="auto_approve" label="Auto Approve">
                    <option @selected($kycSetting->auto_approve == 0) value="0">Disable</option>
                    <option @selected($kycSetting->auto_approve == 1) value="1">Enable</option>
                  </x-admin.input-select>
                </div>

                <div class="col-md-6">
                  <x-admin.input-select name="status" label="KYC Status">
                    <option @selected($kycSetting->status == 1) value="1">Active</option>
                    <option @selected($kycSetting->status == 0) value="0">Inactive</option>
                  </x-admin.input-select>
                </div>

              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Save')" onclick="$('form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection