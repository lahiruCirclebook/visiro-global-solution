<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('Record ID');
            $table->smallInteger('student_id')->unsigned()->index()->comment('Student ID');
            $table->smallInteger('course_id')->unsigned()->index()->comment('Course ID');
            $table->timestamps();

            //foreign key
            $table->foreign('student_id')->references('id')->on('students')->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('Restrict')->onUpdate('Cascade');
        });

        //table name
        DB::statement("ALTER TABLE student_courses comment 'Student Courses'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
