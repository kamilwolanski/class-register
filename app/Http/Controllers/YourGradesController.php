<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;

class YourGradesController extends Controller
{
    public function show(string $id, string $subjectId, string $studentId)
    {
        //id=id klasy subjectId= id klasy userId= id studenta

        $user = auth()->user();

        // Pobieranie nauczyciela wraz z relacjami
        $teacher = $user->teacher->load('classrooms');

        // Pobierz klasę, do której należy nauczyciel
        $classroom = $teacher->classrooms()->where('classrooms.id', $id)->first();

        if (!$classroom) {
            return redirect()->route('classes.index')->with('error', 'Nie znaleziono klasy.');
        }

        // Pobierz uczniów z ich ocenami dla danego przedmiotu, doładowując relację "subject"
        $student = $classroom->students()
    ->where('students.id', $studentId) // Dodaj warunek filtrujący studenta po jego ID
    ->with([
        'grades' => function ($query) use ($subjectId) {
            $query->where('subject_id', $subjectId)->with(['subject', 'teacher']);
        }
    ])
    ->get();
        return view('grades.create', compact('id', 'subjectId', 'student'));
    }


    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'new_grade' => 'required|numeric|min:1|max:6', // Dostosuj do zakresu ocen
        ]);

        $grade->update([
            'grade' => $request->new_grade,
        ]);

        return redirect()->back()->with('success', 'Ocena została zaktualizowana.');
    }

    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
            'grade' => 'required|numeric|min:1|max:6', // Dostosuj do zakresu ocen
            'subject_id' => 'required|exists:subjects,id', // Upewnij się, że id przedmiotu jest prawidłowe
        ]);
       // dd($request);
        $user = auth()->user();
        $grade = new Grade();
        $grade->grade = $request->grade;
        $grade->subject_id = $request->subject_id;
        $grade->student_id = $request->student_id; // Załóżmy, że student_id jest przesyłane w formularzu
        $grade->teacher_id = $user->id;
        $grade->reason = $request->reason;
        $grade->save();
        
        return redirect()->back()->with('success', 'Ocena została dodana.');
    }

    public function destroy(Grade $grade)
{
    try {
        $grade->delete(); // Usuń ocenę
        return redirect()->back()->with('success', 'Ocena została usunięta.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Wystąpił błąd podczas usuwania oceny.');
    }
}
}