@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Final Election Results</h3>
        <a href="{{ route('admin.results') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Results
        </a>
    </div>

    <!-- Winners Summary -->
    <div class="mt-8">
        <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 overflow-hidden shadow-lg sm:rounded-lg border-2 border-green-300 dark:border-green-700">
            <div class="p-6">
                <h4 class="text-2xl font-bold text-green-900 dark:text-green-100 mb-6 flex items-center">
                    <svg class="h-8 w-8 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Election Winners
                </h4>
                
                @if(count($winners) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($winners as $position => $winner)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 border-l-4 border-yellow-400">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="h-10 w-10 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $position }}</p>
                                        <h5 class="text-xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $winner->name }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $winner->party }}</p>
                                        <div class="mt-3 flex items-center">
                                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $winner->votes_count }}</span>
                                            <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">votes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300 text-center py-8">No votes have been cast yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Detailed Results by Position -->
    <div class="mt-8">
        <h4 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Detailed Results by Position</h4>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                @foreach($positions as $position => $candidates)
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 border-b dark:border-gray-700 pb-2 mb-4">{{ $position }}</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Rank</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Candidate</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Party</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Votes</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sortedCandidates = $candidates->sortByDesc('votes_count');
                                        $totalVotes = $sortedCandidates->sum('votes_count');
                                    @endphp
                                    @foreach($sortedCandidates as $candidate)
                                        <tr class="{{ $loop->first && $candidate->votes_count > 0 ? 'bg-yellow-50 dark:bg-yellow-900 border-l-4 border-yellow-400' : '' }}">
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                                @if($loop->first && $candidate->votes_count > 0)
                                                    <span class="flex items-center font-bold text-yellow-600 dark:text-yellow-400">
                                                        <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        #{{ $loop->iteration }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-600 dark:text-gray-400">#{{ $loop->iteration }}</span>
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                                <div class="flex items-center">
                                                    <span class="font-medium text-gray-900 dark:text-gray-200 {{ $loop->first && $candidate->votes_count > 0 ? 'text-lg' : '' }}">
                                                        {{ $candidate->name }}
                                                    </span>
                                                    @if($loop->first && $candidate->votes_count > 0)
                                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                            WINNER
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400">{{ $candidate->party }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-200 font-bold">{{ $candidate->votes_count }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400">
                                                @if($totalVotes > 0)
                                                    {{ number_format(($candidate->votes_count / $totalVotes) * 100, 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
