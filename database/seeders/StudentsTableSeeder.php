<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject = Subject::create(['name' => 'Matematyka']);

        // Tworzenie użytkownika - nauczyciela
        $user1 = User::create([
            'name' => 'Marek',
            'email' => 'marek@example.com',
            'password' => Hash::make('Nauczyciel!890795'),
            'role_id' => 2, // rola 2 to nauczyciel
        ]);

        // Tworzenie nauczyciela
        $teacher = Teacher::create([
            'name' => $user1->name,
            'surname' => 'Kowalski',
            'subject_id' => $subject->id,
            'user_id' => $user1->id,
        ]);

        // Tworzenie użytkownika - ucznia
        $user2 = User::create([
            'name' => 'Jakub',
            'email' => 'jakub@example.com',
            'password' => Hash::make('Uczen!890795'),
            'role_id' => 2, // rola 1 to uczen
        ]);

        $classroom = Classroom::create(['name' => '1A']);

        $student = Student::create([
            'user_id' => $user2->id,
            'name' => $user2->name,
            'surname' => 'Abramowicz',
            'classroom_id' => $classroom->id,
        ]);

        Grade::create([
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'grade' => 4,
        ]);
    }
}
