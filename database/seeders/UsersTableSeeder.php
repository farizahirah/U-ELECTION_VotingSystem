<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'role_id' => 1,
            'email' => 'admin@lightbp.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'student_id' => 1111,
            'security_number' => 1111,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Testing user',
            'role_id' => 2,
            'email' => 'user@lightbp.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'student_id' => 2222,
            'security_number' => 2222,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
