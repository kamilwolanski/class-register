<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja: Nauczyciel wystawia wiele ocen
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
