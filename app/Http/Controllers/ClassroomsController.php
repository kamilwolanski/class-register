<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role->id === 2) {
            // Pobieranie nauczyciela wraz z relacjami
            $teacher = $user->teacher->load('subject', 'classrooms');
            // dd($teacher);

            // Pobranie przedmiotu i klas
            $subject = $teacher->subject;
            $classrooms = $teacher->classrooms;

        } else if ($user->role->id === 1) {
            $student = Student::where('user_id', $user->id)->first();
            // Pobieramy oceny dla tego studenta wraz z przedmiotami
            $grades = $student->grades()->with(['subject', 'teacher'])->get();

            // Grupujemy oceny według przedmiotu
            $groupedGrades = $grades->groupBy(function ($grade) {
                return $grade->subject->name; // Grupowanie według nazwy przedmiotu
            });

        return view('classes.index', compact('groupedGrades'));

        } else {
            // Jeśli to administrator, pobieramy wszystkie klasy razem z uczniami
            $classrooms = Classroom::with('students')->get(); // Pobieramy wszystkie klasy z uczniami
            $classroomsWithStudents = $classrooms; // Zapisujemy klasy w tej zmiennej
        }

        return view('classes.index', compact('teacher', 'subject', 'classrooms', 'groupedGrades'));
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
    public function show(string $id)
    {
        // $classroom = Classroom::with('students')->findOrFail($id);
        // $classroom = $teacher->classrooms()->where('classroom_id', $classroomId)->first();
        // // dd($classroom);
        // return view('classes.show', compact('classroom'));
        $user = auth()->user();

        if ($user->role->id === 2) {
            // Pobieranie nauczyciela wraz z relacjami
            $teacher = $user->teacher->load('classrooms');
            $subjectId = $teacher->subject_id;
            $classroom = $teacher->classrooms()->where('classrooms.id', $id)->first();
            $students = $classroom->students->load('grades');
            $students->load([
                'grades' => function ($query) use ($subjectId) {
                    $query->where('subject_id', $subjectId);
                }
            ]);
            // $grades = $students->load('grades');
            // dd($grades);
            return view('classes.show', compact('classroom', 'students'));
        }
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
