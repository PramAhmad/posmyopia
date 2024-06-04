<label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
<input {{ $attributes->merge(['class' => 'form-control']) }}>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@endif