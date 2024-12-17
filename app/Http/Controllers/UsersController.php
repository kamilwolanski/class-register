<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function show()
    {
        return view('users.index');
    }
}