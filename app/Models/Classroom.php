<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relacja: Klasa posiada wielu uczniów
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teacherClassrooms()
    {
        return $this->hasMany(TeacherClassroom::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_classroom');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_classroom');
    }

}
