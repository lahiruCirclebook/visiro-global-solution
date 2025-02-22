<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentQualificationsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_qualifications', function (Blueprint $table) {
            Schema::table('student_qualifications', function (Blueprint $table) {
                // Drop the existing incorrect foreign key
                $table->dropForeign(['id']);

                // Add the correct foreign key
                $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict')->onUpdate('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_qualifications', function (Blueprint $table) {
            // Drop the updated foreign key
            $table->dropForeign(['student_id']);

            // Restore the original incorrect foreign key (if needed)
            $table->foreign('id')->references('id')->on('students')->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
