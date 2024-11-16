<div class="container">
    <h1>Klasy i przedmioty, które uczysz</h1>
    @if($classroomsWithSubjects->isEmpty())
        <p>Nie uczysz żadnych klas.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa klasy</th>
                    <th>Przedmiot</th>
                    <th>Oceny</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classroomsWithSubjects as $entry)
                    <tr>
                        <td>{{ $entry['classroom']->name }}</td>
                        <td>{{ $entry['subject']->name }}</td>
                        <td><a href="{{ route('classes.show_with_subject', ['class' => $entry['classroom']->id, 'subjectId' => $entry['subject']->id]) }}">Oceny</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>