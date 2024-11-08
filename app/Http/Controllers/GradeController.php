<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // Wyświetlanie listy ocen dla danego ucznia
    public function index()
    {
        $grades = Grade::with('student')->get();
        return view('grades.index', compact('grades'));
    }
}
