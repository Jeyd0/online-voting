@extends('layouts.admin')

@section('content')
    <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Dashboard</h3>

    <div class="mt-4">
        @foreach($candidates->groupBy('position') as $position => $group)
        <h4 class="text-xl text-gray-600 dark:text-gray-300 font-semibold mt-8 mb-4">{{ $position }}</h4>
        <div class="flex flex-wrap -mx-6">
            @foreach($group as $candidate)
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mt-4">
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="mx-5 flex-1">
                        <h4 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $candidate->votes_count }}</h4>
                        <div class="text-gray-500 dark:text-gray-400">{{ $candidate->name }} ({{ $candidate->party }})</div>
                    </div>
                    <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
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