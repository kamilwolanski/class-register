<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassroom extends Model
{
    use HasFactory;

    // Relacja: Kombinacja nauczyciela, przedmiotu i klasy może mieć wiele planów lekcji
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // Relacja do nauczyciela
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relacja do przedmiotu
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relacja do klasy
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
