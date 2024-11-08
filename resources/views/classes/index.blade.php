<h1>classes</h1>

@foreach ($classes as $class)
    <h2>Klasa: {{ $class->name }}</h2>
    
    <ul>
        @foreach ($class->students as $student)
            <li>{{ $student->name }} {{ $student->surname }}</li>
        @endforeach
    </ul>
@endforeach

