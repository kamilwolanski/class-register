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
                        @foreach ($groupedGrades as $subjectName => $grades)
                            <div class="subject">
                                <h3>Przedmiot: {{ $subjectName }}</h3>
                                <ul>
                                    @foreach ($grades as $grade)
                                        <li>
                                            Ocena: {{ $grade->grade }} - nauczyciel {{$grade->teacher->name}}
                                            {{$grade->teacher->surname}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
