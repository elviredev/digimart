<div class="mb-3">
  <label class="form-label">{{ $label }}</label>
  <input
    type="{{ $type == null ? 'text' : $type }}"
    name="{{ $name }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
  >

  @if($hint)
    <span class="form-hint">{{ $hint }}</span>
  @endif

  <x-input-error :messages="$errors->get($name)" />
</div>