@props([
    'id' => null,
    'label' => null,
    'name' => null,
    'options' => [],
    'selected' => null,
    'displayField' => '' 
])

<div class="form-group mb-2">
    @if ($label)
        <label for="{{ $id }}" class="form-label fw-semibold">{{ $label }}</label>
    @endif

    <select {{ $attributes->merge(['class' => 'form-select', 'name' => $name, 'id' => $id]) }}>
        <option value="">Select</option>
        @foreach ($options as $key => $value)
            <option value="{{ $value->id }}" {{ $selected == $key ? 'selected' : '' }}>
                {{ $value->{$displayField} }}
            </option>
        @endforeach
    </select>

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
