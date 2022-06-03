<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'name' => 'Juan Perez',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
