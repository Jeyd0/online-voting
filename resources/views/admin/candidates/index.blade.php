@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-gray-700 dark:text-gray-200 text-3xl font-medium">Candidates</h3>
        <a href="{{ route('admin.candidates.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Candidate
        </a>
    </div>

    <div class="mt-8">
        @foreach($candidates->groupBy('party') as $party => $group)
        <h4 class="text-xl text-gray-600 dark:text-gray-300 font-semibold mt-8 mb-4">PARTYLIST - {{ $party }}</h4>
        <div class="flex flex-col mb-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 dark:border-gray-700">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach($group as $candidate)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                    <div class="text-sm leading-5 font-medium text-gray-900 dark:text-gray-200">{{ $candidate->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                    <div class="text-sm leading-5 text-gray-500 dark:text-gray-400">{{ $candidate->position }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 dark:border-gray-700 text-sm leading-5 font-medium">
                                    <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
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