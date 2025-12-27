<div class="form_box">
  <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">
    {{ $label }}
  </label>
  <div>
    <select
      name="{{ $name }}"
      {{ $attributes->merge(['class' => 'common-input border']) }}
      id="{{ $name }}"
    >
      <option value="">{{ __('Select') }}</option>
      {{ $slot }}
    </select>
  </div>
  <x-input-error :messages="$errors->get($name)" />
</div>