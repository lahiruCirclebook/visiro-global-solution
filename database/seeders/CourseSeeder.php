<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('courses')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('courses')->insert([
            [
                'name' => 'Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Software Engineer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
