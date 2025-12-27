@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Candidates</h3>
        <div class="flex" style="gap: 10px;">
            <a href="{{ route('admin.candidates.create') }}" class="text-white font-bold py-2 px-4 rounded" style="background-color: #2563eb;" onmouseover="this.style.backgroundColor='#3b82f6'" onmouseout="this.style.backgroundColor='#2563eb'">
                Add Candidate
            </a>
            <form action="{{ route('admin.candidates.destroyAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete ALL candidates? This cannot be undone.');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white font-bold py-2 px-4 rounded" style="background-color: #dc2626;" onmouseover="this.style.backgroundColor='#ef4444'" onmouseout="this.style.backgroundColor='#dc2626'">
                    Delete All Candidates
                </button>
            </form>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mt-6">
        <form method="GET" action="{{ route('admin.candidates.index') }}" class="flex gap-2">
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ $search ?? '' }}" 
                       placeholder="Search by name, position, or party..." 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @if($search ?? false)
                <a href="{{ route('admin.candidates.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <div class="mt-8" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; justify-items: center; text-align: center;">
        @foreach($candidates->groupBy('party') as $party => $group)
        <div class="flex flex-col" style="width: 100%;">
            <h4 class="text-xl text-gray-600 dark:text-gray-300 font-semibold mb-4">PARTYLIST - {{ $party }}</h4>
            <div class="-my-2 py-2 overflow-x-auto">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 dark:border-gray-700">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider" style="text-align: center;">Name</th>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider" style="text-align: center;">Position</th>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach($group as $candidate)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700" style="text-align: center;">
                                    <div class="text-sm leading-5 font-medium text-gray-900 dark:text-gray-200">{{ $candidate->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700" style="text-align: center;">
                                    <div class="text-sm leading-5 text-gray-500 dark:text-gray-400">{{ $candidate->position }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700 text-sm leading-5 font-medium" style="text-align: center;">
                                    <div class="flex justify-center" style="gap: 10px;">
                                        <a href="{{ route('admin.candidates.edit', $candidate) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                        <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection