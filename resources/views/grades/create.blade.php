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
           
        </tbody>
    </table>
</div>
                    <a href="{{ route('classes.show_with_subject', ['class' => $id, 'subjectId' => $subjectId]) }}" class="block mt-4 text-blue-500">Wróć do listy klas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
