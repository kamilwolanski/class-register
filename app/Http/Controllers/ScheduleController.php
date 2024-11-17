<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // Zakładam, że masz autoryzację
        $role = $user->role->name; // Pobierz rolę użytkownika

        if ($role === 'student') {
            // Pobierz dane ucznia
            $student = $user->student;
            $teacherClassrooms = $student->classroom->teacherClassrooms;

            $schedules = $teacherClassrooms->flatMap(function ($teacherClassroom) {
                return $teacherClassroom->schedules;
            });
            return view('schedule.index', ['schedules' => $schedules]);

        } else if ($role === 'teacher') {
            $teacher = $user->teacher;
            $teacherClassrooms = $teacher->teacherClassrooms;
            $schedules = $teacherClassrooms->flatMap(function ($teacherClassroom) {
                return $teacherClassroom->schedules;
            });
            return view('schedule.index', ['schedules' => $schedules]);

        }

        // Przekaż dane do widoku
        // return view('schedule.index', [
        //     'schedules' => $schedules,
        //     'role' => $role,
        // ]);
    }
}
