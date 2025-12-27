<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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

                    @php
                        $election = \App\Models\Election::find(1);
                    @endphp

                    @if($election && $election->status === 'pending')
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <div class="flex items-center">
                                <span class="font-bold">Voting has not started yet!</span>
                            </div>
                            <p class="mt-2">Please wait for the administrator to start the voting. You will be notified once the election begins.</p>
                        </div>
                    @elseif($election && $election->status === 'closed')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <div class="flex items-center">
                                <span class="font-bold">Voting has ended!</span>
                            </div>
                            <p class="mt-2">The voting period has ended. Please check the results page for final election results.</p>
                        </div>
                    @elseif($election && $election->status === 'active')
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <div class="flex items-center">
                                <span class="font-bold">Voting is now open!</span>
                            </div>
                            <p class="mt-2">The election is currently ongoing. Cast your vote now!</p>
                        </div>
                    @endif

                    <p class="text-gray-700">You're logged in!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
