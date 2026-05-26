<div class="d-flex justify-content-between align-items-center py-1">
    <div class="text-secondary small">
        &copy; {{ date('Y') }}
        <a href="{{ homeRoute() }}" class="text-secondary">{{ config('app.name') }}</a>
    </div>
    <div class="text-secondary small">
        v{{ config('app.version', '1.0') }}
    </div>
</div>
