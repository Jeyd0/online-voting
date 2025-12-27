<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Election Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($positions as $position => $candidates)
                        @php
                            $totalVotes = $candidates->sum('votes_count');
                        @endphp
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">{{ $position }}</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Party</th>
                                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Votes</th>
                                            @if($election && $election->status === 'closed')
                                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($candidates->sortByDesc('votes_count') as $candidate)
                                            @php
                                                $percentage = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 2) : 0;
                                            @endphp
                                            <tr class="{{ $loop->first ? 'bg-green-50' : '' }}">
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <span class="font-medium text-gray-900">{{ $candidate->name }}</span>
                                                        @if($loop->first && $candidate->votes_count > 0)
                                                            @if($election && $election->status === 'closed')
                                                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                    Winner
                                                                </span>
                                                            @else
                                                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                    Leading
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-200 text-gray-500">{{ $candidate->party }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200 text-gray-900 font-bold">{{ $candidate->votes_count }}</td>
                                                @if($election && $election->status === 'closed')
                                                    <td class="py-2 px-4 border-b border-gray-200 text-gray-900 font-semibold">{{ $percentage }}%</td>
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
    </div>
</x-app-layout>
