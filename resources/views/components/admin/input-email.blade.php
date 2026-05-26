@props(['name', 'label', 'description', 'value', 'required'])

<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
        {!! ($required ?? false) ? '<span class="text-danger ms-1">*</span>' : '' !!}
    </label>
    <input type="email"
           id="{{ $name }}"
           class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
           name="{{ $name }}"
           value="{{ old($name) ?? $value ?? '' }}"
           {{ ($required ?? false) ? 'required' : '' }} />

    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
    @if (!empty($description))
        <small class="form-hint text-secondary">{{ $description }}</small>
    @endif
</div>
