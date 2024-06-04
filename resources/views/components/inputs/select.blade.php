<label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
<select {{ $attributes->merge(['class' => 'form-select']) }}>
    {{ $slot }}
</select>
@error('{{ $name }}')
    <small class="text-danger">{{ $message }}</small>
@enderror