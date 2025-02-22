<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQualification extends Model
{
    use HasFactory;

    protected $table = 'student_qualifications';
    protected $primaryKey = 'id';
    public $timestamps = true;


    protected $fillable = ['student_id', 'qualification'];

    //make relation with students table
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
