<h1>asdsa</h1>

@foreach ($grades as $grade)
    <p>{{ $grade->student->grade }} - {{ $grade->subject }}: {{ $grade->grade }}</p>
@endforeach
