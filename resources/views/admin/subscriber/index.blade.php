@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">{{ __('Send Newsletter') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.send-newsletter') }}" method="POST" class="x-newsletter-form">
              @csrf

              <x-admin.input-text name="subject" :label="__('Subject')" />
              <x-admin.input-textarea name="message" id="editor" :label="__('Message')" />
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Send')" onclick="$('.x-newsletter-form').submit()" />
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Subscribers List') }}</h3>
          </div>

          <div class="card-body">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Date</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($subscribers as $subscriber)
                    <tr>
                      <td>{{ $subscriber->email }}</td>
                      <td>{{ formatDate($subscriber->created_at) }}</td>
                      <td>
                        <a class="delete-item text-danger ms-2" href="{{ route('admin.subscribers.destroy', $subscriber->id) }}">
                          <i class="ti ti-trash"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="text-center">{{ __('No subscribers found.') }}</td>
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

