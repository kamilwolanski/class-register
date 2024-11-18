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
            $schedulesGrouped = $schedules->groupBy('day_of_week');
            $hours = $schedules->pluck('hour')->unique()->sort();


            return view('schedule.index', [
                'schedulesGrouped' => $schedulesGrouped,
                'hours' => $hours,
                'role' => $role,
            ]);

        } else if ($role === 'teacher') {
            $user = auth()->user();
            $teacher = $user->teacher;
            $teacherClassrooms = $teacher->teacherClassrooms;

            // Pobranie i zorganizowanie planu lekcji
            $schedules = $teacherClassrooms->flatMap(function ($teacherClassroom) {
                return $teacherClassroom->schedules;
            });

            // Grupowanie po dniach tygodnia
            $schedulesGrouped = $schedules->groupBy('day_of_week');

            // Przygotowanie unikalnych godzin lekcyjnych
            $hours = $schedules->pluck('hour')->unique()->sort();

            // Przekazanie danych do widoku
            return view('schedule.index', [
                'schedulesGrouped' => $schedulesGrouped,
                'hours' => $hours,
                'role' => $role,
            ]);

        }

        // Przekaż dane do widoku
        // return view('schedule.index', [
        //     'schedules' => $schedules,
        //     'role' => $role,
        // ]);
    }
}
