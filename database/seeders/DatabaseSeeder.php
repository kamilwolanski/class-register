<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use App\Models\Classroom;
use App\Models\TeacherClassroom;
use App\Models\Schedule;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);

        // Tworzymy przedmioty
        $subjects = $this->createSubjects();

        // Tworzymy użytkowników
        $users = $this->createUsers();

        // Tworzymy nauczycieli
        $teachers = $this->createTeachers($users);

        // Tworzymy klasy
        $classrooms = $this->createClassrooms();

        // Tworzymy powiązania nauczycieli z klasami i przedmiotami
        $this->assignTeachersToClassrooms($teachers, $subjects, $classrooms);

        // Tworzymy rozkład zajęć
        $this->createSchedules();

        // Tworzymy studentów i oceny
        $this->createStudentsAndGrades($users, $classrooms, $teachers, $subjects);

        // Tworzymy administratora
        $this->createAdmin();
    }

    private function createSubjects()
    {
        return [
            Subject::firstOrCreate(['name' => 'Matematyka']),
            Subject::firstOrCreate(['name' => 'Geografia']),
        ];
    }

    private function createUsers()
    {
        return [
            'marek@example.com' => User::firstOrCreate(['email' => 'marek@example.com'], ['name' => 'Marek', 'password' => Hash::make('Nauczyciel!890795'), 'role_id' => 2]),
            'jakub@example.com' => User::firstOrCreate(['email' => 'jakub@example.com'], ['name' => 'Jakub', 'password' => Hash::make('Uczen!890795'), 'role_id' => 1]),
            'tomek@example.com' => User::firstOrCreate(['email' => 'tomek@example.com'], ['name' => 'Tomasz', 'password' => Hash::make('Uczen!890795'), 'role_id' => 1]),
            'mariusz@example.com' => User::firstOrCreate(['email' => 'mariusz@example.com'], ['name' => 'Mariusz', 'password' => Hash::make('Nauczyciel!890795'), 'role_id' => 2]),
        ];
    }

    private function createTeachers($users)
    {
        return [
            'marek' => Teacher::firstOrCreate(['user_id' => $users['marek@example.com']->id], ['name' => $users['marek@example.com']->name, 'surname' => 'Kowalski']),
            'mariusz' => Teacher::firstOrCreate(['user_id' => $users['mariusz@example.com']->id], ['name' => $users['mariusz@example.com']->name, 'surname' => 'Nogaj']),
        ];
    }

    private function createClassrooms()
    {
        return [
            '1A' => Classroom::firstOrCreate(['name' => '1A']),
            '2A' => Classroom::firstOrCreate(['name' => '2A']),
        ];
    }

    private function assignTeachersToClassrooms($teachers, $subjects, $classrooms)
    {
        TeacherClassroom::firstOrCreate(['teacher_id' => $teachers['marek']->id, 'subject_id' => $subjects[0]->id, 'classroom_id' => $classrooms['1A']->id]);
        TeacherClassroom::firstOrCreate(['teacher_id' => $teachers['marek']->id, 'subject_id' => $subjects[0]->id, 'classroom_id' => $classrooms['2A']->id]);
        TeacherClassroom::firstOrCreate(['teacher_id' => $teachers['mariusz']->id, 'subject_id' => $subjects[1]->id, 'classroom_id' => $classrooms['1A']->id]);
        TeacherClassroom::firstOrCreate(['teacher_id' => $teachers['mariusz']->id, 'subject_id' => $subjects[1]->id, 'classroom_id' => $classrooms['2A']->id]);
    }

    private function createSchedules()
    {
        $schedules = [
            // 1A Monday
            ['teacher_classroom_id' => 1, 'day_of_week' => 1, 'hour' => 1],
            ['teacher_classroom_id' => 1, 'day_of_week' => 1, 'hour' => 2],
            ['teacher_classroom_id' => 3, 'day_of_week' => 1, 'hour' => 3],
            // 1A Tuesday
            ['teacher_classroom_id' => 3, 'day_of_week' => 2, 'hour' => 1],
            ['teacher_classroom_id' => 1, 'day_of_week' => 2, 'hour' => 2],
            ['teacher_classroom_id' => 1, 'day_of_week' => 2, 'hour' => 3],
            // 2A Monday
            ['teacher_classroom_id' => 4, 'day_of_week' => 1, 'hour' => 1],
            ['teacher_classroom_id' => 4, 'day_of_week' => 1, 'hour' => 2],
            ['teacher_classroom_id' => 2, 'day_of_week' => 1, 'hour' => 3],
        ];

        foreach ($schedules as $schedule) {
            Schedule::firstOrCreate($schedule);
        }
    }

    private function createStudentsAndGrades($users, $classrooms, $teachers, $subjects)
    {
        // Student 1A
    $student1 = Student::firstOrCreate(['user_id' => $users['jakub@example.com']->id], ['name' => $users['jakub@example.com']->name, 'surname' => 'Abramowicz', 'classroom_id' => $classrooms['1A']->id]);
    Grade::firstOrCreate(['student_id' => $student1->id, 'teacher_id' => $teachers['marek']->id, 'subject_id' => $subjects[0]->id], ['grade' => 4, 'reason' => 'Kartkówka']);
    Grade::firstOrCreate(['student_id' => $student1->id, 'teacher_id' => $teachers['mariusz']->id, 'subject_id' => $subjects[1]->id], ['grade' => 2, 'reason' => 'Sprawdzian']);

    // Student 2A
    $student2 = Student::firstOrCreate(['user_id' => $users['tomek@example.com']->id], ['name' => $users['tomek@example.com']->name, 'surname' => 'Abramowicz', 'classroom_id' => $classrooms['2A']->id]);
    Grade::firstOrCreate(['student_id' => $student2->id, 'teacher_id' => $teachers['mariusz']->id, 'subject_id' => $subjects[1]->id], ['grade' => 3, 'reason' => 'Kartkówka']);
    Grade::firstOrCreate(['student_id' => $student2->id, 'teacher_id' => $teachers['marek']->id, 'subject_id' => $subjects[0]->id], ['grade' => 5, 'reason' => 'Sprawdzian']);
    }

    private function createAdmin()
    {
        User::firstOrCreate(['email' => 'admin@example.com'], ['name' => 'admin', 'password' => Hash::make('Admin!890795'), 'role_id' => 3]);
    }
}
