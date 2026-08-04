@extends('admin.layout')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <p class="text-slate-400 mt-1">Overview of your application metrics</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-slate-900 border border-slate-800 shadow-xl p-6 rounded-lg shadow-sm">
        <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Churches</h3>
        <p class="text-4xl font-bold mt-2 text-white">{{ $stats['churches'] }}</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 shadow-xl p-6 rounded-lg shadow-sm">
        <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Verified Churches</h3>
        <p class="text-4xl font-bold mt-2 text-indigo-400">{{ $stats['verified'] }}</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 shadow-xl p-6 rounded-lg shadow-sm">
        <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider">Categories</h3>
        <p class="text-4xl font-bold mt-2 text-white">{{ $stats['categories'] }}</p>
    </div>
</div>

<div class="bg-slate-900 border border-slate-800 shadow-xl p-6 rounded-lg">
    <h3 class="text-lg font-bold mb-4">Churches by Category</h3>
    <div class="w-full h-80">
        <canvas id="categoryChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        const chartData = @json($chartData);
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Number of Churches',
                    data: chartData.data,
                    backgroundColor: 'rgba(99, 102, 241, 0.8)', // indigo-500
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#94a3b8' },
                        grid: { color: 'rgba(30, 41, 59, 0.5)' } // slate-800
                    },
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection