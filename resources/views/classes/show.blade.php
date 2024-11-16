<div class="container">
    <h1>Szczegóły klasy: {{ $classroom->name }}</h1>
    <h2>Przedmiot: {{ $students->first()?->grades->first()?->subject->name ?? 'Nieznany przedmiot' }}</h2>

    @if($students->isEmpty())
        <p>Brak uczniów w tej klasie.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Imię i nazwisko ucznia</th>
                    <th>Oceny</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }} {{ $student->surname }}</td>
                        <td>
                            @if($student->grades->isEmpty())
                                Brak ocen
                            @else
                                @foreach($student->grades as $grade)
                                    <span class="badge bg-primary">{{ $grade->grade }}</span>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('classes.index') }}" class="btn btn-secondary mt-3">Wróć do listy klas</a>
</div>