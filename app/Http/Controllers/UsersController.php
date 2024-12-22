<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherClassroom;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function show(Request $request)
        {
            // Pobierz rolę i ID z zapytania, jeśli istnieją
            $role = $request->get('role');
            $userId = $request->get('id');
            // Pobierz wszystkich użytkowników (ID i imiona)
            $allUsers = User::select('id', 'name')->get();
            $classrooms = Classroom::all();
            $subjects = Subject::all();
            // Pobierz użytkowników z opcjonalnym filtrowaniem
            $users = User::when($role, function ($query, $role) {
                return $query->whereHas('role', function ($q) use ($role) {
                    $q->where('name', $role);  // Filtruj użytkowników na podstawie roli
                });
            })
            ->when($userId, function ($query, $userId) {
                return $query->where('id', $userId);  // Filtruj użytkowników na podstawie ID, jeśli podano
            })
            ->get();
            // Przekaż dane do widoku
            return view('users.index', compact('users', 'role', 'userId', 'allUsers', 'classrooms', 'subjects'));
        }
        public function destroy($id)
        {
            $user = User::findOrFail($id);
            if ($user->role->name === 'admin') {
                session()->flash('error', 'Nie można usunąć użytkownika z uprawnieniami Admina.');
                return redirect()->back();
            }
            $user->delete();
            return redirect()->back();
        }
        public function edit($id)
        {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        }
        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'role_id' => 'required',
            ]);         
            $user = User::findOrFail($id);
            $user->update($validatedData);
            return redirect()->route('users.index')->with('success', 'Użytkownik został zaktualizowany');
        }
        public function store(Request $request)
        {
                //DODANIE ADMINA
                // Walidacja danych wejściowych
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'role_id' => 'required|exists:roles,id', // Zmieniona nazwa pola i dodano regułę exists
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $value)) {
                            $fail("Hasło musi zawierać co najmniej jedną dużą literę, małą literę, cyfrę i symbol specjalny.");
                        }
                    },
                ],
            ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'role_id' => $request->input('role_id'),
                    'password' => bcrypt($request->input('password')),
                ]);
                $newUserId = $user->id;

                if($request->input('role_id')==1){
                    $student = Student::create([
                        'name' => $request->input('name'),
                        'surname' => $request->input('surname'),
                        'user_id' => $newUserId,
                        'classroom_id' => $request->input('classroom'),
                    ]);
                }
                if($request->input('role_id')==2){
                    //DODANIE NAUCZYCIELA
                    $teacher = Teacher::create([
                        'name' => $request->input('name'),
                        'surname' => $request->input('surname'),
                        'user_id' => $newUserId,
                    ]);
                    $newTeacherId = $teacher->id;
                    $teacherClassrom = TeacherClassroom::create([
                        'teacher_id' => $newTeacherId,
                        'subject_id' => $request->input('subject'),
                        'classroom_id' => $request->input('classroom'),
                    ]);  
                }
                return redirect()->route('users.index')->with('success', 'Użytkownik został dodany');
            }
}