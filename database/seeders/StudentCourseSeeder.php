<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('student_courses')->truncate();  // Clear the table before inserting new data
        Schema::enableForeignKeyConstraints();

        DB::table('student_courses')->insert([
            [
                'student_id' => 1,  // Correct student ID
                'course_id' => 1,   // Correct course ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2,  // Correct student ID
                'course_id' => 2,   // Correct course ID (2 in this case)
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
