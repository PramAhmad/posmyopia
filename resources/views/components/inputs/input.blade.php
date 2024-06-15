@props([
    'id' => null,
    'label' => null,
    'name' => null
])

<label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
<input {{ $attributes->merge(['class' => 'form-control', 'name' => $name, 'id' => $id]) }}>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@endif