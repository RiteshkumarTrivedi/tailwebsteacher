<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'subject', 'marks','teacher_id'];

    // Define relationships, e.g. student belongs to a teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
