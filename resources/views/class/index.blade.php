<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klasa ') . $classId }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border border-gray-300 text-center w-full">Uczniowie</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($students as $student)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-300 text-center w-full">{{ $student->name }} {{ $student->surname }}</td>
        
                        </tr>
                        @empty
                        <tr class="bg-white">
                            <td colspan="4">Brak uczniów do wyświetlenia.</td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>