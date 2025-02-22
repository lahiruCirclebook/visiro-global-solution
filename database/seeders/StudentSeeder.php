<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('students')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('students')->insert([
            [
                'name' => 'chandima',
                'email' => 'chandima@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'lahiru',
                'email' => 'lahiru@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
