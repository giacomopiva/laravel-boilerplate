@extends('layouts.app')

@section('content')

{{-- ── Page header ────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Sistema</div>
                <h2 class="page-title">Modifica utente</h2>
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
                            <i class="ti ti-edit me-2 text-secondary"></i>{{ $user->name }}
                        </h3>
                        <div class="card-options">
                            <span class="badge {{ $user->status ? 'bg-success-lt text-success' : 'bg-danger-lt text-danger' }}">
                                {{ $user->status ? 'Attivo' : 'Disabilitato' }}
                            </span>
                        </div>
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

                        <form action="{{ route('admin.user.update', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <x-admin.input-text
                                :name="'name'"
                                :label="'Nome'"
                                :value="old('name') ?? $user->name"
                                :description="null"
                                :placeholder="'Nome completo dell\'utente'"
                                :rounded="true"
                                :required="true" />

                            <x-admin.input-text
                                :name="'email'"
                                :label="'Email'"
                                :value="old('email') ?? $user->email"
                                :description="null"
                                :placeholder="'Indirizzo email dell\'utente'"
                                :rounded="true"
                                :required="true" />

                            <div class="mb-3">
                                <label class="form-label" for="password">Nuova password</label>
                                <input type="password"
                                       id="password"
                                       class="form-control rounded-3 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       name="password"
                                       maxlength="255"
                                       placeholder="Lascia vuoto per mantenere la password attuale" />
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <x-admin.select
                                :name="'role'"
                                :options="$roles"
                                :label="'Ruolo'"
                                :description="null"
                                :placeholder="'Seleziona un ruolo'"
                                :rounded="true"
                                :check="old('role') ?? $user->roles->first()->name"
                                :required="true" />

                            <x-admin.select
                                :name="'status'"
                                :options="$status"
                                :label="'Stato'"
                                :description="null"
                                :placeholder="'Seleziona uno stato'"
                                :rounded="true"
                                :check="old('status') ?? $user->status"
                                :required="true" />

                            <div class="mt-4 d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i>Salva
                                </button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-ghost-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Indietro
                                </a>
                                <a href="{{ route('admin.user.print', $user->id) }}"
                                    class="btn btn-ghost-secondary" title="Stampa">
                                    <i class="ti ti-printer me-1"></i>Stampa
                                </a>
                                @if ($user->id != Auth::user()->id)
                                    <x-admin.ajax-del-button-link :url="'admin/user'" :resource="$user" />
                                @endif
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
