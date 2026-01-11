<label class="form-check form-switch form-switch-3">
  <input type="hidden" name="{{ $name }}" value="0">
  <input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-check-input']) }} type="checkbox" @checked($checked) value="1">
  <span class="form-check-label">{{ $label }}</span>
</label>
<x-input-error :messages="$errors->get($name)" />
