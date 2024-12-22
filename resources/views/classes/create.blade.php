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
                    <h2>Imię i nazwisko:
                        {{ $student->first()->name }}    {{ $student->first()->surname }}  
                    </h2>
                    <h2>Przedmiot:
                        {{ $student->first()?->grades->first()?->subject->name ?? 'Nieznany przedmiot' }}  
                    </h2>

                        <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border border-gray-300 text-left">Oceny</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Rodzaj aktywności</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left">Edycja</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($student->first()->grades as $grade)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                <td class="px-4 py-2 border border-gray-300">
                                    <span class="badge bg-blue-500 text-white py-1 px-3 rounded-full mr-2">{{ $grade->grade }}</span>
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $grade->reason }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    <!-- EDYTUJ-->
                                    <button 
                                        class="text-blue-500 hover:text-blue-700 mx-2" 
                                        onclick="openModal({{ $grade->id }}, '{{ $grade->grade }}')">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <!-- USUŃ -->
                                    <form action="{{ route('classes.destroy', ['grade' => $grade->id]) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Czy na pewno chcesz usunąć tgo użytkownika?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <!-- ROZWIŃ -->
                                    <button 
                                        class="text-blue-500 hover:text-blue-700 mx-2" 
                                        onclick="toggleDetails({{ $grade->id }})">
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Ukryty wiersz z dodatkowymi informacjami -->
                            <tr id="details-{{ $grade->id }}" class="hidden bg-gray-100">
                                <td colspan="4" class="px-4 py-2 border border-gray-300">
                                    <strong>Data dodania:</strong> {{ $grade->created_at }} <br>
                                    <strong>Data edycji:</strong> {{ $grade->updated_at }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- Przycisk do dodania nowej oceny -->
                        <button class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600" onclick="openAddGradeModal()">Dodaj ocenę</button>
                    </div>
                <a href="{{ route('classes.show_with_subject', ['class' => $id, 'subjectId' => $subjectId]) }}" class="block mt-4 text-blue-500">Wróć do dziennika</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal do edytowania oceny -->
    <div id="edit-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">Edytuj ocenę</h3>
                <form id="edit-form" method="POST" action="{{ route('classes.update', ['grade' => ':gradeId']) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="old-grade" class="block text-sm font-medium text-gray-700">Stara ocena</label>
                        <input 
                            type="text" 
                            id="old-grade" 
                            name="old_grade" 
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100" 
                            readonly>
                    </div>
                    <div class="mb-4">
                        <label for="new-grade" class="block text-sm font-medium text-gray-700">Nowa ocena</label>
                        <input 
                            type="number" 
                            id="new-grade" 
                            name="new_grade" 
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md" 
                            required
                            min="1" 
                            max="6">
                    </div>
                    <div class="flex justify-end">
                        <button 
                            type="button" 
                            class="mr-2 px-4 py-2 text-sm text-gray-500 hover:text-gray-700" 
                            onclick="closeModal()">Anuluj</button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 text-sm bg-blue-500 text-white hover:bg-blue-600 rounded">
                            Zapisz zmiany
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Modal do dodawania nowej oceny -->
   <div id="add-grade-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">Dodaj ocenę</h3>
                <form id="add-form" method="POST" action="{{ route('classes.store') }}">
                    @csrf
                    <!-- Pole dla student_id -->
                    <input type="hidden" name="student_id" value="{{ $student->first()->id }}">

                    <div class="mb-4">
                        <label for="new-grade" class="block text-sm font-medium text-gray-700">Ocena</label>
                        <input 
                            type="number" 
                            id="new-grade" 
                            name="grade" 
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md" 
                            required
                            min="1" 
                            max="6">
                    </div>

                    <!-- Pole dla subject_id -->
                    <input type="hidden" name="subject_id" value="{{ $subjectId }}">
                    <div class="mb-4">
                        <label for="grade-reason" class="block text-sm font-medium text-gray-700">Rodzaj aktywności</label>
                        <select id="grade-reason" name="reason" class="block w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="Kartkówka">Kartkówka</option>
                            <option value="Sprawdzian">Sprawdzian</option>
                            <option value="Praca domowa">Praca domowa</option>
                            <option value="Projekt">Projekt</option>
                            <option value="Aktywość">Aktywność</option>
                            <option value="Inne">Inne</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button 
                            type="button" 
                            class="mr-2 px-4 py-2 text-sm text-gray-500 hover:text-gray-700" 
                            onclick="closeAddGradeModal()">Anuluj</button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 text-sm bg-green-500 text-white hover:bg-green-600 rounded">
                            Dodaj ocenę
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    function openModal(gradeId, oldGrade) {
    document.getElementById('old-grade').value = oldGrade;
    const route = "{{ route('classes.update', ':gradeId') }}";
    const form = document.getElementById('edit-form');
    form.action = route.replace(':gradeId', gradeId);   
    document.getElementById('edit-modal').classList.remove('hidden');
    }
    // Funkcja do zamknięcia modalu edytowania
    function closeModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
    // Funkcja do otwarcia modalu dodawania nowej oceny
    function openAddGradeModal() {
        document.getElementById('add-grade-modal').classList.remove('hidden');
    }
    // Funkcja do zamknięcia modalu dodawania
    function closeAddGradeModal() {
        document.getElementById('add-grade-modal').classList.add('hidden');
    }
    function toggleDetails(gradeId) {
    var detailsRow = document.getElementById('details-' + gradeId);
    if (detailsRow.classList.contains('hidden')) {
        detailsRow.classList.remove('hidden');  // Pokaż wiersz
    } else {
        detailsRow.classList.add('hidden');     // Ukryj wiersz
    }
}
</script>