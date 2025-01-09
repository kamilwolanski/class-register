<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{
    public function show(Request $request)
    {
        $classrooms = Classroom::all();
        return view('manage.index', compact('classrooms'));
    }

    public function showClass($classId)
    {
        $classroom = Classroom::findOrFail($classId);
        $students = $classroom->students()->get();
        return view('class.index', compact('students', 'classId'));
    }

    public function destroy(Classroom $class)
    {
        $class->delete();
        return redirect()->back();
    }
      
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $classroom = Classroom::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('manage.index')->with('success', 'Klasa dodana!');
    }
}