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


        // Pobieranie nauczyciela wraz z relacjami
        $teacher = $user->teacher->load('subject', 'classrooms');

        $subject = $teacher->subject;
        $classrooms = $teacher->classrooms;

        return view('classes.index', compact('teacher', 'subject', 'classrooms'));
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
        $user = auth()->user();


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

        return view('classes.show', compact('classroom', 'students'));

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
