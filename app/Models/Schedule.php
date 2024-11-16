<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_classroom_id',
        'day_of_week',
        'hour',
    ];

    // Relacja: Plan lekcji odnosi się do kombinacji nauczyciel-przedmiot-klasa
    public function teacherClassroom()
    {
        return $this->belongsTo(TeacherClassroom::class);
    }

    // Opcjonalne relacje: uzyskiwanie dostępu do nauczyciela, przedmiotu i klasy
    public function teacher()
    {
        return $this->teacherClassroom->teacher();
    }

    public function subject()
    {
        return $this->teacherClassroom->subject();
    }

    public function classroom()
    {
        return $this->teacherClassroom->classroom();
    }
}
