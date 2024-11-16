<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relacja: Przedmiot posiada wiele ocen
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function teacherClassrooms()
    {
        return $this->hasMany(TeacherClassroom::class);
    }

    // Relacja: Przedmiot posiada wiele zapisów obecności
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relacja: Jeden przedmiot ma wielu nauczycieli
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

}
