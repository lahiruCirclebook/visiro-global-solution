<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class StudentQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('student_qualifications')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('student_qualifications')->insert([
            [
                'student_id' => 1,
                'qualification' => 'Diploma In SE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2,
                'qualification' => 'Certificate In Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
