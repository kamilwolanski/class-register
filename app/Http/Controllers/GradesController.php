<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $student = Student::where('user_id', $user->id)->first();
        // Pobieramy oceny dla tego studenta wraz z przedmiotami
        $grades = $student->grades()->with(['subject', 'teacher'])->get();

        // Grupujemy oceny według przedmiotu
        $groupedGrades = $grades->groupBy(function ($grade) {
            return $grade->subject->name; // Grupowanie według nazwy przedmiotu
        });

        return view('grades.index', compact('groupedGrades'));
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
        //
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
