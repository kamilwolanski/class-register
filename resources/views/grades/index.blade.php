<h1>Oceny</h1>

<table border="1">
    <thead>
        <tr>
            <th>Student</th>
            <th>Nauczyciel</th>
            <th>Przedmiot</th>
            <th>Ocena</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->student->name }} {{ $grade->student->surname }}</td>
                <td>{{ $grade->teacher->name }} {{ $grade->teacher->surname }}</td>
                <td>{{ $grade->subject->name }}</td>
                <td>{{ $grade->grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
