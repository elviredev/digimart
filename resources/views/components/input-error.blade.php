@props(['messages'])

@if ($messages)
  @foreach($messages as $message)
    <span {{ $attributes->merge(['class' => 'text-danger d-block']) }}>
      {{ $message }}
    </span>
  @endforeach
@endif
