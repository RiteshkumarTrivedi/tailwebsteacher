<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['username', 'email', 'password','name'];

    protected $table="teachers";

    

    public function students()
{
    return $this->hasMany(Student::class);
}
}
