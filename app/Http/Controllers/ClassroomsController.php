<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $teacher = $user->teacher;

        // Pobierz klasy z przedmiotami
        $classroomsWithSubjects = $teacher->classrooms()
            ->withPivot('subject_id') // Pobierz dane z tabeli pośredniej
            ->with('teachers')
            ->get()
            ->map(function ($classroom) use ($teacher) {
                $subjectId = $classroom->pivot->subject_id;
                $subject = $teacher->subjects()->find($subjectId);
                return [
                    'classroom' => $classroom,
                    'subject' => $subject,
                ];
            });

        // Przekaż dane do widoku
        return view('classes.index', compact('classroomsWithSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $subjectId)
    {
        $id_klasy = $id;
        $id_przedmiotu = $subjectId;
        $user = auth()->user();

        // Pobieranie nauczyciela wraz z relacjami
        $teacher = $user->teacher->load('classrooms');

        // Pobierz klasę, do której należy nauczyciel
        $classroom = $teacher->classrooms()->where('classrooms.id', $id)->first();

        if (!$classroom) {
            return redirect()->route('classes.index')->with('error', 'Nie znaleziono klasy.');
        }

        // Pobierz uczniów z ich ocenami dla danego przedmiotu, doładowując relację "subject"
        $students = $classroom->students()
            ->with([
                'grades' => function ($query) use ($subjectId) {
                    $query->where('subject_id', $subjectId)->with(['subject', 'teacher']);
                }
            ])
            ->get();

        
        //pobieramy pogrupowane przedmioty
        $subjects = Subject::all();
        //$student = Subject::all();

        return view('classes.show', compact('classroom', 'students', 'id_klasy', 'id_przedmiotu', 'subjects'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
