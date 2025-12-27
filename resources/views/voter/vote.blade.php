<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote for your Candidate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @php
                        $election = \App\Models\Election::find(1);
                    @endphp
                    
                    @if($election && $election->status === 'closed')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-bold">Voting has been stopped!</span>
                            </div>
                            <p class="mt-2">The voting period has ended. You can no longer cast your vote. Please check the results page for final election results.</p>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('vote') }}" method="POST" {{ $election && $election->status === 'closed' ? 'onsubmit="return false;"' : '' }}>
                        @csrf
                        <div class="space-y-6" {{ $election && $election->status === 'closed' ? 'style="opacity: 0.5; pointer-events: none;"' : '' }}>
                            @foreach($candidates as $position => $group)
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">{{ $position }}</h3>
                                    <div class="space-y-4 ml-4">
                                        @foreach($group as $candidate)
                                        <div class="flex items-center">
                                            <input id="candidate_{{ $candidate->id }}" name="votes[{{ $position }}]" type="radio" value="{{ $candidate->id }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="candidate_{{ $candidate->id }}" class="ml-3 block text-sm font-medium text-gray-700">
                                                {{ $candidate->name }} <span class="text-gray-500">({{ $candidate->party }})</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <button type="submit" {{ $election && $election->status === 'closed' ? 'disabled' : '' }} class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ $election && $election->status === 'closed' ? 'Voting Closed' : 'Submit Vote' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>