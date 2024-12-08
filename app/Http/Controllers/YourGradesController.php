<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;

class YourGradesController extends Controller
{
    public function show(string $id, string $subjectId, string $userId)
    {
        return view('grades.create', compact('id', 'subjectId', 'userId'));
    }
}