<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subject_id', 'present', 'date'];

    // Relacja: Obecność dotyczy ucznia
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relacja: Obecność dotyczy przedmiotu
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
