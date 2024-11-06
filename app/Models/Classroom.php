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
}
