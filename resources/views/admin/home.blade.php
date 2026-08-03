@extends('layouts.app')

@section('content')

{{-- ── Page header ────────────────────────────────── --}}
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Admin</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <span class="text-secondary small">
                    <i class="ti ti-calendar me-1"></i>
                    {{ now()->locale('it')->isoFormat('dddd D MMMM YYYY') }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- ── Page body ───────────────────────────────────── --}}
<div class="page-body" id="app">
    <div class="container-xl">

        {{-- Stat cards --}}
        <div class="row row-cards mb-3">

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue text-white avatar">
                                    <i class="ti ti-users"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Utenti totali</div>
                                <div class="text-secondary small">Registrati nel sistema</div>
                            </div>
                            <div class="col-auto">
                                <div class="h2 mb-0" id="stat-total-users">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    // ── Vue: stat cards ───────────────────────────────────────────────────────
    const { createApp } = Vue;
    createApp({
        data() {
            return { 
                stats: { 
                    totalUsers: 0 
                } 
            };
        },
        mounted() { 
            this.loadStats(); 
        },
        methods: {
            loadStats() {
                // TODO: sostituire con chiamata API reale
                // axios.get('/admin/api/stats').then(r => { ... });
                this.stats = { 
                    totalUsers: 2 
                };

                document.getElementById('stat-total-users').textContent  = this.stats.totalUsers;
            }
        }
    }).mount('#app');
</script>
@endsection
