<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Użytkownicy') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('users.index') }}">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <!-- Kolumna "Filtruj po roli" -->
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/2">
                                    <label for="role">Filtruj po roli:</label>
                                    <select name="role" id="role" onchange="resetIdFilter(); this.form.submit()">
                                        <option value="">Wszystkie role</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Nauczyciel</option>
                                    </select>
                                </th>
                                <!-- Kolumna "Filtruj po użytkowniku" -->
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/2">
                                    <label for="id">Filtruj po użytkowniku:</label>
                                    <select name="id" id="id" onchange="resetRoleFilter(); this.form.submit()">
                                        <option value="">Wybierz użytkownika</option>
                                        @foreach($allUsers as $user)
                                            <option value="{{ $user->id }}" {{ request('id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Wiersze tabeli (opcjonalnie, jeśli chcesz dodać jakąś tabelę z wynikami) -->
                        </tbody>
                    </table> 
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h2 class="text-center">Lista użytkowników</h2>
                    <table class="min-w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/5">ID</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/5">Imię</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/5">Email</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/5">Rola</th>
                                <th class="px-4 py-2 border border-gray-300 text-center w-1/5"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">{{ $user->id }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">{{ $user->name }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">
                                        @if($user->role->name === 'teacher')
                                            Nauczyciel
                                        @else
                                            {{ $user->role->name }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">
<!-- Ikona Rozwiń -->
                                       <button 
                                            class="text-blue-500 hover:text-blue-700 mx-2" 
                                            onclick="toggleDetails({{ $user->id }})">
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                    
                                    </td>
                                </tr>
                                <tr id="details-{{ $user->id }}" class="bg-gray-100 hidden">
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">
                                        Stworzono: {{ $user->created_at }}<br>
                                        @if($user->updated_at == $user->created_at )
                                        Edytowano: Nigdy
                                        @else                   
                                        Edytowano: {{ $user->updated_at }}                    
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">f</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">f</td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">
                                    <button 
                                        class="text-blue-500 hover:text-blue-700 mx-2" 
                                        onclick="openModal({{ $user->id }})">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 text-center w-1/5">
                                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white">
                                    <td colspan="4">Brak użytkowników do wyświetlenia.</td>
                                </tr>
                                @endforelse
                                <!-- Ukryty wiersz z dodatkowymi informacjami -->
                        </tbody>
                    </table> 
            </div>
        </div>
        <button onclick="openAddModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                Dodaj użytkownika
            </button>
    </div>

    @if ($errors->any())
            <!-- Error modal -->
        <div id="error-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white rounded-lg p-6 w-96">
                    <h3 class="text-xl font-semibold mb-4">Błąd hasła!</h3>
                    @foreach ($errors->all() as $error)
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ $error }}</label>
                        </div>
                        @endforeach
                        <div class="flex justify-end">
                            <button type="button" onclick="closeErrorModal(), openAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Zamknij</button>
                        </div>
                </div>
            </div>
        @endif




<!-- Modal do dodawania użytkownika -->
<div id="add-user-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-xl font-semibold mb-4">Dodaj użytkownika</h3>
            <form id="add-user-form" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Imię</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Hasło</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Rola</label>
                    <select id="role" name="role_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="3">Admin</option>
                        <option value="1">Student</option>
                        <option value="2">Nauczyciel</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Anuluj</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Dodaj</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal do edycji użytkownika -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-xl font-semibold mb-4">Edytuj użytkownika</h3>
            <form id="edit-form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- Przykładowe pola edycji -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Imię</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Rola</label>
                    <select id="role" name="role_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="3">Admin</option>
                        <option value="1">Student</option>
                        <option value="2">Nauczyciel</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Anuluj</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
    <script>
// Funkcja do otwarcia modalu edytowania użytkownika
    function openModal(userId) {
        const form = document.getElementById('edit-form');
        form.action = `/users/${userId}`;
        document.getElementById('edit-modal').classList.remove('hidden');
        
    }

    // Funkcja do zamknięcia modalu edytowania
    function closeModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }


    //zamknięcie error modal
    function closeErrorModal() {
        document.getElementById('error-modal').classList.add('hidden');
    }





    // Funkcja do otwarcia modalu dodawania nowego użytkownika
    function openAddGradeModal() {
        document.getElementById('add-user-modal').classList.remove('hidden');
    }

    // Funkcja do zamknięcia modalu dodawania
    function closeAddGradeModal() {
        document.getElementById('add-user-modal').classList.add('hidden');
    }



        
        function resetIdFilter() {
            // Jeśli wybrano rolę, resetujemy filtr ID
            document.getElementById('id').value = '';
        }

        function resetRoleFilter() {
            // Jeśli wybrano użytkownika, resetujemy filtr roli
            document.getElementById('role').value = '';
        }
        function toggleDetails(userId) {
            var detailsRow = document.getElementById('details-' + userId);
            if (detailsRow.classList.contains('hidden')) {
                detailsRow.classList.remove('hidden');
            } else {
                detailsRow.classList.add('hidden');
            }
        }
        function openAddModal() {
            document.getElementById('add-user-modal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('add-user-modal').classList.add('hidden');
        }
    </script>
</x-app-layout>