<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('Student ID');
            $table->string('name',250)->comment('Student Name');
            $table->string('email',20)->unique()->comment('Student Email');
            $table->timestamps();
        });

        //table name
        DB::statement("ALTER TABLE students comment 'Students'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
