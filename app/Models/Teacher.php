<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'surname'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja: Nauczyciel wystawia wiele ocen
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function teacherClassrooms()
    {
        return $this->hasMany(TeacherClassroom::class);
    }

    // Relacja: Nauczyciel może uczyć wiele klas
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'teacher_classroom');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_classroom');
    }
    
}
