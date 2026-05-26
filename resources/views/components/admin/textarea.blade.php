@props(['name', 'label', 'description', 'value', 'required', 'rows'])

<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
        {!! ($required ?? false) ? '<span class="text-danger ms-1">*</span>' : '' !!}
    </label>
    <textarea id="{{ $name }}"
              class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
              name="{{ $name }}"
              rows="{{ $rows ?? 5 }}"
              style="resize: vertical;"
              {{ ($required ?? false) ? 'required' : '' }}>{{ old($name) ?? $value ?? '' }}</textarea>

    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
    @if (!empty($description))
        <small class="form-hint text-secondary">{{ $description }}</small>
    @endif
</div>
