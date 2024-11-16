<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_id', 'teacher_id', 'grade'];

    // Relacja: Ocena należy do ucznia
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relacja: Ocena dotyczy przedmiotu
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relacja: Ocena jest wystawiana przez nauczyciela
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
