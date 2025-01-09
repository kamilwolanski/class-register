<x-app-layout>
    <x-slot name="header">
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h2 class="text-center">Lista Klas</h2>
                    <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/3">Nazwa</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/3">Uczniowie</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/3">Usuń</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classrooms as $class)
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/3">{{ $class->name }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/3">

                                        <a href="{{ route('class.index', ['classroom' => $class->name]) }}"
                                            class="text-blue-500 hover:text-blue-700 mx-2">
                                            <i class="fa fa-user"></i>
                                        </a>
                                    </form>
                                    
                                    </td>

                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/3">

                                    <form action="{{ route('manage.destroy', ['class' => $class]) }}" method="POST" class="inline-block ml-2">                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Czy na pewno chcesz usunąć tę klasę?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white">
                                    <td colspan="4">Brak klas do wyświetlenia.</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table> 
            </div>
        </div>
        <button onclick="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-4">
                Dodaj klasę
        </button>
    </div>

    <div id="add-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-xl font-semibold mb-4">Dodaj klasę</h3>
                <form id="add-class-form" method="POST" action="{{ route('manage.store') }}">
                    @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nazwa</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Anuluj</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </x-slot>

    <script>

    function closeModal() {
        document.getElementById('add-modal').classList.add('hidden');
    }

    function openModal() {
        document.getElementById('add-modal').classList.remove('hidden');
    }

    </script>
</x-app-layout>