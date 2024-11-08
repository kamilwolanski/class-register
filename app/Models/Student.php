<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'surname', 'classroom_id']; // Dodajemy class_id do fillable

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja: Uczeń należy do jednej klasy
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // Inne relacje (np. grades, attendances)
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
