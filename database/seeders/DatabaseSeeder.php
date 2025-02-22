<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(StudentSeeder::class);//student seeder
        $this->call(CourseSeeder::class);//course seeder
        $this->call(StudentQualificationSeeder::class);//student qualification seeder
        $this->call(StudentCourseSeeder::class);//student course seeder
    }
}
