@props(['name', 'label', 'description', 'options', 'check', 'required', 'disabled', 'readonly', 'empty', 'placeholder', 'rounded'])

<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
        {!! ($required ?? false) ? '<span class="text-danger ms-1">*</span>' : '' !!}
    </label>
    <select id="{{ $name }}"
            class="form-select {{ ($rounded ?? false) ? 'rounded-3' : '' }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
            name="{{ $name }}"
            {{ ($required ?? false) ? 'required' : '' }}
            @disabled(($disabled ?? false) == true)
            @readonly(($readonly ?? false) == true)>

        @if ($empty ?? false)
            <option value="">{{ $placeholder ?? 'Seleziona' }}</option>
        @endif

        @foreach ($options as $key => $option)
            <option value="{{ $key }}"
                @selected( old($name) ? $key == old($name) : $key == ($check ?? null) )>
                {{ $option }}
            </option>
        @endforeach

    </select>

    @if ($errors->has($name))
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
    @if (!empty($description))
        <small class="form-hint text-secondary">{{ $description }}</small>
    @endif
</div>
