<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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
            // Jeśli to nauczyciel, wyświetlamy tylko klasy, które nauczyciel uczy
            $teacher = $user->teacher; // Zakładając, że masz relację teacher() w modelu User
            $classrooms = $teacher->classrooms; // Pobieramy klasy nauczyciela

            // Eager loading uczniów dla każdej klasy
            $classroomsWithStudents = $classrooms->load('students'); // Ładujemy uczniów dla tych klas
        } else {
            // Jeśli to administrator, pobieramy wszystkie klasy razem z uczniami
            $classrooms = Classroom::with('students')->get(); // Pobieramy wszystkie klasy z uczniami
            $classroomsWithStudents = $classrooms; // Zapisujemy klasy w tej zmiennej
        }

        return view('classes.index', compact('classroomsWithStudents'));
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
