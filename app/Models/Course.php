<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name'];

    //make relation with student courses table
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses');
    }
}
