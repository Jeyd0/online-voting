<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h1 class="text-3xl font-bold text-green-600 mb-4">Thank You!</h1>
                    <p class="text-lg text-gray-700">Your vote has been recorded successfully.</p>
                    <a href="{{ route('dashboard') }}" class="mt-6 inline-block text-blue-600 hover:underline">Return to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>