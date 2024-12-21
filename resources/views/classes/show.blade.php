<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klasa') }} {{ $classroom->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                            <h2>Przedmiot:
                                {{ $students->first()?->grades->first()?->subject->name ?? 'Nieznany przedmiot' }}
                            </h2>

                            @if($students->isEmpty())
                                <p>Brak uczniów w tej klasie.</p>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="px-4 py-2 border border-gray-300 text-left">Imię i nazwisko ucznia
                                                </th>
                                                <th class="px-4 py-2 border border-gray-300 text-left">Oceny</th>
                                                <th class="px-4 py-2 border border-gray-300 text-left">Edycja </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                                    <td class="px-4 py-2 border border-gray-300">{{ $student->name }}
                                                        {{ $student->surname }}</td>
                                                    <td class="px-4 py-2 border border-gray-300">
                                                        @if($student->grades->isEmpty())
                                                            <span class="text-gray-500 italic">Brak ocen</span>
                                                        @else
                                                            @foreach($student->grades as $grade)
                                                                <span
                                                                    class="badge bg-blue-500 text-white py-1 px-3 rounded-full mr-2">{{ $grade->grade }}</span>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border border-gray-300">
                                                    <a href="{{ route('classes.show', ['class' => $id_klasy, 'subjectId' => $id_przedmiotu, 'studentId' => $student->id]) }}" class="block mt-4 text-blue-500">Edytuj</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif
                            
                        
                            <a href="{{ route('classes.index') }}" class="block mt-4 text-blue-500">Wróć do listy klas</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>