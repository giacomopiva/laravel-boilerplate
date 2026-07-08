@props(['name', 'label', 'id', 'description', 'value', 'maxlength', 'required', 'placeholder', 'rounded'])

<div class="mb-3">
    <label class="form-label" for="{{ $id ?? $name }}">
        {{ $label }}
        {!! ($required ?? false) ? '<span class="text-danger ms-1">*</span>' : '' !!}
    </label>
    <input type="text"
           id="{{ $id ?? $name }}"
           class="form-control {{ ($rounded ?? false) ? 'rounded-3' : '' }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
           name="{{ $name }}"
           value="{{ $value ?? '' }}"
           maxlength="{{ $maxlength ?? 255 }}"
           placeholder="{{ $placeholder ?? '' }}"
           {{ ($required ?? false) ? 'required' : '' }} />

    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
    @if (!empty($description))
        <small class="form-hint text-secondary">{{ $description }}</small>
    @endif
</div>
