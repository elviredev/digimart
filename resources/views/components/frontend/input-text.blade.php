<div {{ $attributes->merge(['class' => 'form_box']) }}>
  <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">
    {{ $label }} @if($required) <code>*</code> @endif
  </label>
  <input
    type="{{ $type == null ? "text" : $type }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'common-input border']) }}
    id="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    >
  <x-input-error :messages="$errors->get($name)" />
</div>