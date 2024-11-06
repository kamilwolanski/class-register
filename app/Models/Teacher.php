<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname'];

    // Relacja: Nauczyciel wystawia wiele ocen
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
