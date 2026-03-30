@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Counter Section') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.counter-section.update', 1) }}" class="x-form" method="POST">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-12">
                  <x-admin.input-text name="title" :label="__('Title')" :value="$counterSection?->title" />
                </div>

                <div class="col-12">
                  <x-admin.input-text name="subtitle" :label="__('Subtitle')" :value="$counterSection?->subtitle" />
                </div>

                <div class="col-md-6">
                  <x-admin.input-text name="label_one" :label="__('Label One')" :value="$counterSection?->label_one" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="counter_one" :label="__('Counter One')" :value="$counterSection?->counter_one" />
                </div>

                <div class="col-md-6">
                  <x-admin.input-text name="label_two" :label="__('Label Two')" :value="$counterSection?->label_two" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="counter_two" :label="__('Counter Two')" :value="$counterSection?->counter_two" />
                </div>

                <div class="col-md-6">
                  <x-admin.input-text name="label_three" :label="__('Label Three')" :value="$counterSection?->label_three" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="counter_three" :label="__('Counter Three')" :value="$counterSection?->counter_three" />
                </div>

                <div class="col-md-6">
                  <x-admin.input-text name="label_four" :label="__('Label Four')" :value="$counterSection?->label_four" />
                </div>
                <div class="col-md-6">
                  <x-admin.input-text name="counter_four" :label="__('Counter Four')" :value="$counterSection?->counter_four" />
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection