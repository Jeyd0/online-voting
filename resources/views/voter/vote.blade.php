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
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('vote') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            @foreach($candidates as $position => $group)
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">{{ $position }}</h3>
                                    <div class="space-y-4 ml-4">
                                        @foreach($group as $candidate)
                                        <div class="flex items-center">
                                            <input id="candidate_{{ $candidate->id }}" name="candidate_id" type="radio" value="{{ $candidate->id }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
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
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Submit Vote
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>