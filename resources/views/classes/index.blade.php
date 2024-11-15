@if (auth()->user()->role->id === 2)
    <h1>Dane nauczyciela</h1>

    <p><strong>Imię i nazwisko:</strong> {{ $teacher->name }}</p>
    <p><strong>Przedmiot:</strong> {{ $subject->name }}</p>

    <h2>Nauczane klasy:</h2>
    <ul>
        @foreach ($classrooms as $classroom)
            <li>{{ $classroom->name }} - <a href="{{ route('classes.show', ['class' => $classroom->id]) }}"
                    class="btn btn-primary">
                    Zobacz oceny
                </a></li>
        @endforeach
    </ul>
@endif


