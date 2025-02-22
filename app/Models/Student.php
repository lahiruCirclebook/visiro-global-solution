<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = true;


    protected $fillable = ['name', 'email'];

    //make relation with student qualifications
    public function qualifications()
    {
        return $this->hasMany(StudentQualification::class);
    }

    //make relation with students course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses');
    }
}
