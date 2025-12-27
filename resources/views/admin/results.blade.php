@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center no-print">
        <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Election Results</h3>
        <div class="flex" style="gap: 10px;">
            @if($election && $election->status === 'closed')
                <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-5 rounded" >
                    Print Results
                </button>
            @endif
            <form action="{{ route('admin.toggle-voting') }}" method="POST" onsubmit="return confirm('Are you sure you want to {{ $election && $election->status === 'active' ? 'stop' : 'start' }} voting?');">
                @csrf
                @if($election && $election->status === 'active')
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Stop Voting
                    </button>
                @else
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Start Voting
                    </button>
                @endif
            </form>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                @foreach($positions as $position => $candidates)
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 border-b dark:border-gray-700 pb-2 mb-4">{{ $position }}</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Candidate</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Party</th>
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Votes</th>
                                        @if($election && $election->status === 'closed')
                                        <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Percentage</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sortedCandidates = $candidates->sortByDesc('votes_count');
                                        $totalVotes = $sortedCandidates->sum('votes_count');
                                    @endphp
                                    @foreach($sortedCandidates as $candidate)
                                        <tr class="{{ $loop->first ? 'bg-green-50 dark:bg-green-900' : '' }}">
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                                <div class="flex items-center">
                                                    <span class="font-medium text-gray-900 dark:text-gray-200">{{ $candidate->name }}</span>
                                                    @if($loop->first && $candidate->votes_count > 0)
                                                        @if($election && $election->status === 'closed')
                                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                                                WINNER
                                                            </span>
                                                        @else
                                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                                                Leading
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400">{{ $candidate->party }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-200 font-bold">{{ $candidate->votes_count }}</td>
                                            @if($election && $election->status === 'closed')
                                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 font-semibold">
                                                @if($totalVotes > 0)
                                                    {{ number_format(($candidate->votes_count / $totalVotes) * 100, 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </td>
                                            @endif
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

    <!-- Print Title (only visible when printing) -->
    <div class="print-only text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Final Election Results</h1>
        <p class="text-gray-600">{{ now()->format('F d, Y') }}</p>
    </div>

    <style>
        @media print {
            /* Hide navigation, sidebar, and buttons */
            .no-print,
            aside,
            nav,
            header,
            .bg-blue-600,
            .bg-green-600,
            .bg-gray-600 {
                display: none !important;
            }

            /* Show print-only elements */
            .print-only {
                display: block !important;
            }

            /* Adjust page layout */
            body {
                background: white !important;
                color: black !important;
            }

            /* Remove dark mode styles */
            .dark\:bg-gray-800,
            .dark\:bg-gray-900,
            .dark\:text-gray-200 {
                background-color: white !important;
                color: black !important;
            }

            /* Table styling for print */
            table {
                border-collapse: collapse;
                width: 100%;
                page-break-inside: avoid;
            }

            th {
                background-color: #f3f4f6 !important;
                color: #111827 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Winner styling for print */
            .bg-green-50 {
                background-color: #fef3c7 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Badge styling */
            .bg-yellow-100 {
                background-color: #fef3c7 !important;
                color: #92400e !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Page breaks */
            .mb-8 {
                page-break-inside: avoid;
            }

            /* Ensure content fits */
            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Hide print-only by default */
        .print-only {
            display: none;
        }
    </style>
@endsection
