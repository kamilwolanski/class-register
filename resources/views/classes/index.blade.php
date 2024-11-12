
<h1>Klasy</h1>

@if (auth()->user()->role->id === 2)
    <p>Jesteś nauczycielem. Wyświetlamy tylko klasy, które uczysz oraz uczniów tych klas.</p>
@else
    <p>Jesteś administratorem. Wyświetlamy wszystkie klasy w systemie z uczniami.</p>
@endif

@foreach ($classroomsWithStudents as $classroom)
    <h2>Klasa: {{ $classroom->name }}</h2>
    
    <h3>Uczniowie:</h3>
    <ul>
        @foreach ($classroom->students as $student)
            <li>{{ $student->name }} {{ $student->surname }}</li>
        @endforeach
    </ul>
@endforeach
