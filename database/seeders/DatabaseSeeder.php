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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);

        $subject = Subject::firstOrCreate(['name' => 'Matematyka']);

        // Tworzenie użytkownika - nauczyciela
        $user1 = User::firstOrCreate([
            'email' => 'marek@example.com',
        ], [
            'name' => 'Marek',
            'password' => Hash::make('Nauczyciel!890795'),
            'role_id' => 2, // rola 2 to nauczyciel
        ]);

        $teacher = Teacher::firstOrCreate([
            'user_id' => $user1->id,
        ], [
            'name' => $user1->name,
            'surname' => 'Kowalski',
            'subject_id' => $subject->id,
        ]);

        $user2 = User::firstOrCreate([
            'email' => 'jakub@example.com',
        ], [
            'name' => 'Jakub',
            'password' => Hash::make('Uczen!890795'),
            'role_id' => 1, // rola 1 to uczen
        ]);

        $classroom = Classroom::firstOrCreate(['name' => '1A']);

        $student = Student::firstOrCreate([
            'user_id' => $user2->id,
        ], [
            'name' => $user2->name,
            'surname' => 'Abramowicz',
            'classroom_id' => $classroom->id,
        ]);

        Grade::firstOrCreate([
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ], [
            'grade' => 4,
        ]);
    }

}
