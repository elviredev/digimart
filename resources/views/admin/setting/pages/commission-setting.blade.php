@extends('admin.setting.master')

@section('setting_content')
  <div class="col-12 col-md-9 d-flex flex-column">
    <div class="card-body">
      <h2 class="mb-4">{{ __('Author Commission Settings') }}</h2>

      <form action="{{ route('admin.settings.commission.update') }}" method="POST" id="x-form">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-12">
            <x-admin.input-text name="author_commission" :label="__('Author Commission (%)')" :value="config('settings.author_commission')" />
          </div>
        </div>
      </form>

    </div>
    <div class="card-footer bg-transparent mt-auto">
      <div class="btn-list justify-content-end">
        <x-admin.submit-button :label="__('Save')" onclick="$('#x-form').submit()" />
      </div>
    </div>
  </div>
@endsection

