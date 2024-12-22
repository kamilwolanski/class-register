<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oceny') }}
        </h2>
    </x-slot>
    @foreach ($groupedGrades as $subjectName => $grades)
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                            {{$subjectName}}
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 border border-gray-300 text-left w-1/6">Oceny</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-3/6">Za Co</th>
                                    <th class="px-4 py-2 border border-gray-300 text-left w-1/6"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($grades as $grade)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                    <td class="px-4 py-2 border border-gray-300 w-1/6">
                                        @if($grades->isEmpty())
                                            <span class="text-gray-500 italic">Brak powodu</span>
                                        @else                                            
                                                <span class="badge bg-blue-500 text-white py-1 px-3 rounded-full mr-2">
                                                    {{ $grade->grade }} 
                                                </span>                                            
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 w-3/6">
                                        @if($grades->isEmpty())
                                            <span class="text-gray-500 italic">Brak ocen</span>
                                        @else
                                            
                                            <span class="text-gray-500 italic">{{ $grade->reason }} </span>                                 
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 w-1/6">
                                        <!-- Ikona Rozwiń -->
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
                                            <strong>Kto wystawił:</strong> {{ $grade->teacher->name }} {{ $grade->teacher->surname }} <br>
                                            <strong>Data dodania:</strong> {{ $grade->created_at }} <br>
                                            @if($grade->updated_at == $grade->created_at )
                                            <strong>Data edycji:</strong> <strong>Brak edycji</strong>
                                            @else                   
                                            <strong>Data edycji:</strong> {{ $grade->updated_at }}                    
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
    @endforeach
</x-app-layout>


<script>
   
    function toggleDetails(gradeId) {
    var detailsRow = document.getElementById('details-' + gradeId);
    if (detailsRow.classList.contains('hidden')) {
        detailsRow.classList.remove('hidden');  // Pokaż wiersz
    } else {
        detailsRow.classList.add('hidden');     // Ukryj wiersz
    }
}
</script>