@extends('layouts.admin.app')

@section('content')

{{-- ── Page header ────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Area utente</div>
                <h2 class="page-title" id="vue-title">Home</h2>
            </div>
        </div>
    </div>
</div>

{{-- ── Page body ───────────────────────────────────── --}}
<div class="page-body" id="app">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <span class="avatar avatar-lg bg-blue me-3 fw-bold text-white fs-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <div>
                                <h3 class="mb-0">Benvenuto, {{ Auth::user()->name }}!</h3>
                                <div class="text-secondary">@{{ smallTitle }}</div>
                            </div>
                        </div>
                        <p class="text-secondary mb-0">
                            Sei connesso come <strong>{{ Auth::user()->getRoleName() }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    const { createApp } = Vue;
    createApp({
        data() {
            return { smallTitle: "Home dell'Utente" };
        }
    }).mount('#app');
</script>
@endsection
