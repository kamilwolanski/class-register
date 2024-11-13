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


@if (auth()->user()->role->id === 1)

    <div class="container">
        <h1>Twoje Oceny</h1>

        @foreach ($groupedGrades as $subjectName => $grades)
            <div class="subject">
                <h3>Przedmiot: {{ $subjectName }}</h3>
                <ul>
                    @foreach ($grades as $grade)
                        <li>
                            Ocena: {{ $grade->grade }} - {{$grade->teacher->name}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endif