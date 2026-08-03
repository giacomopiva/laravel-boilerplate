@extends('layouts.app')

@section('content')

{{-- ── Page header ────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Sistema</div>
                <h2 class="page-title">Crea nuovo utente</h2>
            </div>
        </div>
    </div>
</div>

{{-- ── Page body ───────────────────────────────────── --}}
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-6">

                <div class="card rounded-3 overflow-hidden">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-user-plus me-2 text-secondary"></i>Dati utente
                        </h3>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <i class="ti ti-alert-triangle me-2 flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h4 class="alert-title">Si è verificato un errore</h4>
                                        <div class="text-secondary small">Controlla i campi e riprova.</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf
                            <div class="space-y">
                                <x-admin.input-text
                                    :name="'name'"
                                    :label="'Nome'"
                                    :value="old('name') ?? ''"
                                    :description="null"
                                    :placeholder="'Nome completo dell\'utente'"
                                    :rounded="true"
                                    :required="true" />

                                <x-admin.input-text
                                    :name="'email'"
                                    :label="'Email'"
                                    :value="old('email') ?? ''"
                                    :description="null"
                                    :placeholder="'Indirizzo email dell\'utente'"
                                    :rounded="true"
                                    :required="true" />

                                <div>
                                    <label class="form-label" for="password">
                                        Password <span class="text-danger ms-1">*</span>
                                    </label>
                                    <input type="password"
                                           id="password"
                                           class="form-control rounded-3 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           name="password"
                                           maxlength="255"
                                           placeholder="Password dell'utente"
                                           required />
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <x-admin.select
                                    :name="'role'"
                                    :options="$roles"
                                    :label="'Ruolo'"
                                    :check="old('role') ?? ''"
                                    :description="null"
                                    :placeholder="'Seleziona un ruolo'"
                                    :rounded="true"
                                    :empty="true"
                                    :required="true" />
                            </div>

                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i>Salva
                                </button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-ghost-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Indietro
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
