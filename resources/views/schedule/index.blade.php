<h1>Plan lekcji</h1>


<table>
    <thead>
        <tr>
            <th>Dzień tygodnia</th>
            <th>Lekcja</th>
            <th>Przedmiot</th>
            <th>Nauczyciel</th>
            <th>Klasa</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $schedule)
                <tr>
                    <td>
                        @php
                            $day = \Carbon\Carbon::now()->setISODate(date('Y'), 1, $schedule->day_of_week);
                            $dayName = $day->locale('pl')->dayName;
                        @endphp
                        {{ $dayName }}
                    </td>
                    <td>{{ $schedule->hour }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->teacher->name }} {{ $schedule->teacher->surname }}</td>
                    <td>{{ $schedule->classroom->name }}</td>
                </tr>
        @endforeach
    </tbody>
</table>