<h1>Klasa: {{ $classroom->name }}</h1>

<h2>Lista uczniów:</h2>
<table class="table">
    <thead>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Oceny</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surname }}</td>
                <td>
                    <!-- Wyświetlenie ocen dla ucznia -->
                    @if ($student->grades->isEmpty())
                        Brak ocen
                    @else
                        <ul>
                            @foreach ($student->grades as $grade)
                                <li>{{ $grade->subject->name }}: {{ $grade->grade }} </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>