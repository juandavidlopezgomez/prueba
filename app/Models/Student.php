<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'last_name',
        'age',
        'email',
    ];

    public function courses()
{
    return $this->belongsToMany(Course::class, 'course_student');
}
}