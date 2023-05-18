<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete(); // to avoid redundant data when re-run the seeder // truncate will make the id = 0 and auto increment from that but delete will auto increment from the last id for ex. 9

        DB::table('users')->insert([
            'id' => 1,
            'name' => "أحمد جمال",
            'email' => "ahmed@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt(12345678),
        ]);
    }
}
