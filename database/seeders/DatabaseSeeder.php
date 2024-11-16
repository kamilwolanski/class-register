<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use App\Models\Classroom;
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

        $subject = Subject::firstOrCreate(['name' => 'Matematyka']);
        $subject2 = Subject::firstOrCreate(['name' => 'Geografia']);

        // Tworzenie użytkownika - nauczyciela
        $user1 = User::firstOrCreate([
            'email' => 'marek@example.com',
        ], [
            'name' => 'Marek',
            'password' => Hash::make('Nauczyciel!890795'),
            'role_id' => 2, // rola 2 to nauczyciel
        ]);

        $user2 = User::firstOrCreate([
            'email' => 'jakub@example.com',
        ], [
            'name' => 'Jakub',
            'password' => Hash::make('Uczen!890795'),
            'role_id' => 1, // rola 1 to uczen
        ]);

        $user3 = User::firstOrCreate([
            'email' => 'tomek@example.com',
        ], [
            'name' => 'Tomasz',
            'password' => Hash::make('Uczen!890795'),
            'role_id' => 1, // rola 1 to uczen
        ]);

        $user4 = User::firstOrCreate([
            'email' => 'mariusz@example.com',
        ], [
            'name' => 'Mariusz',
            'password' => Hash::make('Nauczyciel!890795'),
            'role_id' => 2, // rola 2 to nauczyciel
        ]);

        $teacher = Teacher::firstOrCreate([
            'user_id' => $user1->id,
        ], [
            'name' => $user1->name,
            'surname' => 'Kowalski',
        ]);
        $teacher2 = Teacher::firstOrCreate([
            'user_id' => $user4->id,
        ], [
            'name' => $user4->name,
            'surname' => 'Nogaj',
        ]);

        

        
        $classroom = Classroom::firstOrCreate(['name' => '1A']);
        $classroom2 = Classroom::firstOrCreate(['name' => '2A']);

        $teacher->classrooms()->syncWithoutDetaching([
            $classroom->id => ['created_at' => now(), 'updated_at' => now(), 'subject_id' => $subject->id],
        ]);
        
        $teacher->classrooms()->syncWithoutDetaching([
            $classroom2->id => ['created_at' => now(), 'updated_at' => now(), 'subject_id' => $subject->id],
        ]);
        
        $teacher2->classrooms()->syncWithoutDetaching([
            $classroom2->id => ['created_at' => now(), 'updated_at' => now(), 'subject_id' => $subject2->id],
        ]);
        
        

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

        Grade::firstOrCreate([
            'student_id' => $student->id,
            'teacher_id' => $teacher2->id,
            'subject_id' => $subject2->id,
        ], [
            'grade' => 2,
        ]);

        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name'=> 'admin',
            'password'=> Hash::make('Admin!890795'),
            'role_id' => 3, // rola 3 to admin
        ]);



        $student2 = Student::firstOrCreate([
            'user_id' => $user3->id,
        ], [
            'name' => $user3->name,
            'surname' => 'Abramowicz',
            'classroom_id' => $classroom2->id,
        ]);

        Grade::firstOrCreate([
            'student_id' => $student2->id,
            'teacher_id' => $teacher2->id,
            'subject_id' => $subject2->id,
        ], [
            'grade' => 3,
        ]);

        Grade::firstOrCreate([
            'student_id' => $student2->id,
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ], [
            'grade' => 5,
        ]);
        
    }

}
