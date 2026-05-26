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

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar">
                                    <i class="ti ti-user-check"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Utenti attivi</div>
                                <div class="text-secondary small">Abilitati al login</div>
                            </div>
                            <div class="col-auto">
                                <div class="h2 mb-0" id="stat-active-users">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-yellow text-white avatar">
                                    <i class="ti ti-user-plus"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Nuovi questo mese</div>
                                <div class="text-secondary small">{{ now()->locale('it')->isoFormat('MMMM') }}</div>
                            </div>
                            <div class="col-auto">
                                <div class="h2 mb-0" id="stat-new-users">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-purple text-white avatar">
                                    <i class="ti ti-shield-check"></i>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Ruoli</div>
                                <div class="text-secondary small">Ruoli configurati</div>
                            </div>
                            <div class="col-auto">
                                <div class="h2 mb-0" id="stat-roles">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Charts — prima riga --}}
        <div class="row row-cards mb-3">

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-trending-up me-2 text-blue"></i>Andamento registrazioni
                        </h3>
                        <div class="card-options">
                            <span class="badge bg-blue-lt text-blue">Ultimi 12 mesi</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart-registrations" style="min-height:260px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-chart-donut me-2 text-purple"></i>Distribuzione ruoli
                        </h3>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div id="chart-roles" style="min-height:260px; width:100%;"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Charts — seconda riga --}}
        <div class="row row-cards">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-chart-bar me-2 text-green"></i>Attività mensile
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="chart-activity" style="min-height:240px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-activity me-2 text-orange"></i>Tasso di attivazione
                        </h3>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div id="chart-activation" style="min-height:240px; width:100%;"></div>
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
            return { stats: { totalUsers: 0, activeUsers: 0, newUsers: 0, roles: 0 } };
        },
        mounted() { this.loadStats(); },
        methods: {
            loadStats() {
                // TODO: sostituire con chiamata API reale
                // axios.get('/admin/api/stats').then(r => { ... });
                this.stats = { totalUsers: 42, activeUsers: 38, newUsers: 5, roles: 3 };
                document.getElementById('stat-total-users').textContent  = this.stats.totalUsers;
                document.getElementById('stat-active-users').textContent = this.stats.activeUsers;
                document.getElementById('stat-new-users').textContent    = this.stats.newUsers;
                document.getElementById('stat-roles').textContent        = this.stats.roles;
            }
        }
    }).mount('#app');

    // ── Chart 1: Area – Andamento registrazioni ───────────────────────────────
    new ApexCharts(document.querySelector('#chart-registrations'), {
        chart: { type: 'area', height: 260, toolbar: { show: false }, fontFamily: 'inherit' },
        series: [{ name: 'Nuovi utenti', data: [4, 7, 5, 9, 12, 8, 15, 18, 14, 22, 19, 25] }],
        xaxis: { categories: ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'], axisBorder: { show: false } },
        yaxis: { labels: { formatter: v => Math.round(v) } },
        colors: ['#206bc4'],
        fill: { type: 'gradient', gradient: { opacityFrom: 0.35, opacityTo: 0.02 } },
        stroke: { curve: 'smooth', width: 2 },
        dataLabels: { enabled: false },
        grid: { strokeDashArray: 4, borderColor: '#e9ecef' }
    }).render();

    // ── Chart 2: Donut – Distribuzione ruoli ──────────────────────────────────
    new ApexCharts(document.querySelector('#chart-roles'), {
        chart: { type: 'donut', height: 260, fontFamily: 'inherit' },
        series: [1, 38, 3],
        labels: ['Admin', 'User', 'Manager'],
        colors: ['#206bc4', '#4299e1', '#a855f7'],
        legend: { position: 'bottom' },
        dataLabels: { enabled: true, formatter: v => Math.round(v) + '%' },
        plotOptions: { pie: { donut: { size: '60%' } } }
    }).render();

    // ── Chart 3: Bar – Attività mensile ───────────────────────────────────────
    new ApexCharts(document.querySelector('#chart-activity'), {
        chart: { type: 'bar', height: 240, toolbar: { show: false }, fontFamily: 'inherit' },
        series: [
            { name: 'Login',      data: [120,145,98,167,210,185,230,195,178,245,220,290] },
            { name: 'Operazioni', data: [45,60,38,72,90,68,95,80,65,110,88,125] }
        ],
        xaxis: { categories: ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'] },
        colors: ['#206bc4', '#2fb344'],
        dataLabels: { enabled: false },
        grid: { strokeDashArray: 4, borderColor: '#e9ecef' },
        legend: { position: 'top' },
        plotOptions: { bar: { borderRadius: 3, columnWidth: '55%' } }
    }).render();

    // ── Chart 4: Radial – Tasso attivazione ───────────────────────────────────
    new ApexCharts(document.querySelector('#chart-activation'), {
        chart: { type: 'radialBar', height: 240, fontFamily: 'inherit' },
        series: [Math.round((38 / 42) * 100)],
        labels: ['Attivi'],
        colors: ['#2fb344'],
        plotOptions: {
            radialBar: {
                hollow: { size: '55%' },
                dataLabels: { name: { fontSize: '14px' }, value: { fontSize: '24px', fontWeight: 700 } }
            }
        }
    }).render();
</script>
@endsection
