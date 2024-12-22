<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klasy') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="font-semibold mb-5">Klasy i przedmioty, które uczy ten nauczyciel</h1>
                        @if($classroomsWithSubjects->isEmpty())
                            <p>Nie uczysz żadnych klas.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2 border border-gray-300 text-left">Nazwa klasy</th>
                                            <th class="px-4 py-2 border border-gray-300 text-left">Przedmiot</th>
                                            <th class="px-4 py-2 border border-gray-300 text-left">Dziennik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classroomsWithSubjects as $entry)
                                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                                <td class="px-4 py-2 border border-gray-300">{{ $entry['classroom']->name }}
                                                </td>
                                                <td class="px-4 py-2 border border-gray-300">{{ $entry['subject']->name }}</td>
                                                <td class="px-4 py-2 border border-gray-300">
                                                    <a href="{{ route('classes.show_with_subject', ['class' => $entry['classroom']->id, 'subjectId' => $entry['subject']->id]) }}"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow">
                                                        Otwórz dziennik
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>