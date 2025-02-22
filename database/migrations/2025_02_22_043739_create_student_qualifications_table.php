<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_qualifications', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('Qualification ID');
            $table->smallInteger('student_id')->unsigned()->index()->comment('Student ID');
            $table->text('qualification')->comment('Qualification');
            $table->timestamps();

            //foreign key 
            $table->foreign('id')->references('id')->on('students')->onDelete('Restrict')->onUpdate('Cascade');
        });

        //table name
        DB::statement("ALTER TABLE student_qualifications comment 'Student Qualifications'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_qualifications');
    }
}
