@extends('layouts.app')

@section('title', 'POS - Ringkasan Penjualan')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body {
    background: #eaf6ff !important;
    overflow-x: hidden;
}
.pos-wrapper {
    width: 100%;
    max-width: 1100px;
    margin: 32px auto 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 16px 32px 16px;
}
.stat-row {
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 28px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.stat-card {
    background: #fff;
    border-radius: 1.1rem;
    box-shadow: 0 4px 16px rgba(0,0,0,0.09);
    padding: 1.5rem 2.2rem 1.2rem 1.7rem;
    min-width: 210px;
    max-width: 360px;
    width: 100%;
    margin-bottom: 0.7rem;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    border: 1.2px solid #e3eaff;
}
.stat-label {
    font-weight: 600;
    font-size: 1.11rem;
    color: #2a7cf7;
    margin-bottom: .33rem;
    display: flex;
    align-items: center;
    gap: .44rem;
}
.stat-value {
    font-size: clamp(1.45rem, 4vw, 2.3rem);
    color: #1ebd54;
    font-family: 'Fira Mono', 'Menlo', 'Consolas', monospace;
    font-weight: bold;
    margin-bottom: 0;
    line-height: 1.17;
    white-space: nowrap;
    letter-spacing: .03em;
}
.stat-value.day {
    color: #0ea5e9;
}
.section-title {
    width: 100%;
    background: linear-gradient(90deg, #228be6 65%, #38bdf8 100%);
    color: #fff;
    font-family: 'Fira Mono', monospace;
    font-size: 1.12rem;
    padding: 0.85rem 2vw 0.75rem 2vw;
    font-weight: 600;
    margin-bottom: 0;
    margin-top: 0.2rem;
    letter-spacing: 0.035em;
    border-radius: 0.7rem 0.7rem 0 0;
    display: flex;
    align-items: center;
    gap: 0.7rem;
    border-bottom: 2px solid #1966c2;
    box-shadow: 0 2px 10px 0 rgba(34,139,230,0.05);
    justify-content: flex-start;
}
.chart-area {
    width: 100%;
    min-height: 340px;
    background: #fff;
    border-radius: 0 0 0.7rem 0.7rem;
    box-shadow: 0 2px 10px 0 rgba(34,139,230,0.045);
    margin-bottom: 0;
    padding: 1.5rem 1rem 1.2rem 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-top: none;
}
canvas#salesChart {
    width: 100% !important;
    max-width: 100% !important;
    height: 50vh !important;
    min-height: 240px;
    background: transparent;
    margin: 0 auto;
    display: block;
}
@media (max-width: 900px) {
    .pos-wrapper { max-width: 98vw; }
    .chart-area { padding: 1rem 0.2rem; }
}
@media (max-width: 700px) {
    .stat-row { flex-direction: column; align-items: center; gap: 1rem;}
    .stat-card { width: 96vw; min-width: 120px; max-width: 99vw; padding: 1rem 0.85rem;}
    .section-title { font-size: .97rem; padding: .6rem 2vw;}
}
</style>
<div class="pos-wrapper">
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-label">
                <i class="bi bi-calendar3"></i> Pendapatan Bulan Ini
            </div>
            <div class="stat-value">
                Rp {{ number_format($monthly_income ?? 0, 0, ',', '.') }}
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">
                <i class="bi bi-calendar-day"></i> Pendapatan Hari Ini
            </div>
            <div class="stat-value day">
                Rp {{ number_format($today_income ?? 0, 0, ',', '.') }}
            </div>
        </div>
    </div>
    <div class="section-title">
        <i class="bi bi-bar-chart-line me-2"></i>
        Grafik Penjualan Bulanan
    </div>
    <div class="chart-area">
        <canvas id="salesChart"></canvas>
    </div>
</div>
<script>
const salesChartLabels = @json($chart_labels ?? []);
const salesChartData = @json($chart_data ?? []).map(e => Number(e));
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: salesChartLabels,
        datasets: [{
            label: 'Pendapatan Harian (Rp)',
            data: salesChartData,
            backgroundColor: 'rgba(34,197,94,0.65)',
            borderColor: 'rgba(16,185,129,1)',
            borderWidth: 2,
            borderRadius: 6,
            maxBarThickness: 38,
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let value = context.parsed.y || 0;
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false,
    }
});
</script>
@endsection