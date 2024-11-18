<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oceny') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="container">
    <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border border-gray-300 text-left">Przedmiot</th>
                <th class="px-4 py-2 border border-gray-300 text-left">Oceny</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedGrades as $subjectName => $grades)
                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                    <td class="px-4 py-2 border border-gray-300">{{ $subjectName }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        @if($grades->isEmpty())
                            <span class="text-gray-500 italic">Brak ocen</span>
                        @else
                            @foreach ($grades as $grade)
                                <span class="badge bg-blue-500 text-white py-1 px-3 rounded-full mr-2">
                                    {{ $grade->grade }} ({{ $grade->teacher->name }} {{ $grade->teacher->surname }})
                                </span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
