@props(['name', 'label', 'checked', 'icon'])

<div class="mb-3">
    <label class="form-check form-switch">
        <input class="form-check-input"
               type="checkbox"
               name="{{ $name }}"
               value="1"
               @checked(old($name, $checked ?? false)) />
        <span class="form-check-label">
            @isset($icon)
                <img src="{{ asset('icons/' . $icon) }}" alt="{{ $label }}"
                     class="me-2" style="height:1.2rem; width:1.2rem; vertical-align:middle;">
            @endisset
            {{ $label }}
        </span>
    </label>
</div>
