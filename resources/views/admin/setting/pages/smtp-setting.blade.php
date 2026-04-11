@extends('admin.setting.master')

@section('setting_content')
  <div class="col-12 col-md-9 d-flex flex-column">
    <div class="card-body">
      <h2 class="mb-4">{{ __('SMTP Settings') }}</h2>

      <form action="{{ route('admin.settings.smtp.update') }}" method="POST" id="x-form">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-12">
            <x-admin.input-text name="smtp_sender_name" :label="__('Sender Name')" :value="config('settings.smtp_sender_name')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-text name="smtp_sender_email" :label="__('Sender Email')" :value="config('settings.smtp_sender_email')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-text name="smtp_recipient_email" :label="__('Recipient Email')" :value="config('settings.smtp_recipient_email')" />
          </div>
          <div class="col-md-12">
            <x-admin.input-text name="smtp_mail_host" :label="__('Mail Host')" :value="config('settings.smtp_mail_host')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-text name="smtp_user_name" :label="__('SMTP User Name')" :value="config('settings.smtp_user_name')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-text name="smtp_user_password" :label="__('SMTP Password')" :value="config('settings.smtp_user_password')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-text name="smtp_port" :label="__('SMTP Port')" :value="config('settings.smtp_port')" />
          </div>
          <div class="col-md-6">
            <x-admin.input-select name="smtp_encryption" :label="__('SMTP Encryption')">
              <option @selected(config('settings.smtp_encryption') == 'ssl') value="ssl">{{ __('SSL') }}</option>
              <option @selected(config('settings.smtp_encryption') == 'tls') value="tls">{{ __('TLS') }}</option>
            </x-admin.input-select>
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

