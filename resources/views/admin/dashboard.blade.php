@extends('layouts.admin')

@section('content')
    <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Dashboard</h3>

    <div class="mt-4">
        {{-- Candidates display removed --}}
    </div>

    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h4 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Vote Distribution</h4>
        <canvas id="voteChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('voteChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($candidates->pluck('name')) !!},
                datasets: [{
                    label: '# of Votes',
                    data: {!! json_encode($candidates->pluck('votes_count')) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection