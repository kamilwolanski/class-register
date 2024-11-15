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