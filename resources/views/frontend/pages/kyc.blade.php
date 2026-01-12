@extends('frontend.layouts.master')

@section('content')
  <!-- ======================== Breadcrumb Two Section Start ===================== -->
  <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
  style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
    <div class="breadcrumb-two">
      <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}"
      alt="" class="bg--gradient">
      <div class="container container-two">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="breadcrumb-two-content text-center">

              <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                <li class="breadcrumb-list__item font-14 text-body">
                  <a href="{{ route('home') }}"
                  class="breadcrumb-list__link text-body hover-text-main">
                    {{ __('Home') }}
                  </a>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__icon font-10">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                </li>
                <li class="breadcrumb-list__item font-14 text-body">
                  <span class="breadcrumb-list__text">{{ __('KYC Verification') }}</span>
                </li>
              </ul>

              <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">
                {{ __('KYC Verification') }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Breadcrumb Two Section End ===================== -->

  <!-- ======================== Formulaire Section Start ===================== -->
  <section class="wsus__login padding-y-120">
    <div class="container">
      <div class="row">
        <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
          <div class="wsus__login_area">
            <h4>{{ __('KYC Verification') }}</h4>
            <p>{{ $kycSetting->instructions }}</p>
            <form method="POST" action="{{ route('kyc.store') }}" enctype="multipart/form-data" >
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <x-frontend.input-select name="document_type" :label="__('Document Type')" :required="true" >
                    @if($kycSetting->nid_verification == 1)
                      <option value="nid">{{ __('NID') }}</option>
                    @endif
                    @if($kycSetting->passport_verification == 1)
                      <option value="passport">{{ __('Passport') }}</option>
                    @endif
                  </x-frontend.input-select>
                </div>

                <div class="col-md-12">
                  <x-frontend.input-text name="document_number" :label="__('Document Number')" :required="true" />
                </div>

                <div class="col-md-12">
                  <x-frontend.input-text class="mb-0" type="file" multiple name="documents[]" :label="__('Attach Documents')" :required="true" />
                </div>
                @if($errors->has('documents'))
                  <span class="text-danger">{{ $errors->first('documents') }}</span>
                @elseif($errors->has('documents.*'))
                  @foreach($errors->get('documents.*') as $error)
                    <span class="text-danger mb-0">{{ $error[0] }}</span>
                  @endforeach
                @endif

                <div class="col-xl-12 mt-3">
                  <div class="wsus__login_imput">
                    <button type="submit" class="btn btn-main btn-lg">
                      {{ __('Submit') }}
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================== Formulaire Section End ===================== -->
@endsection