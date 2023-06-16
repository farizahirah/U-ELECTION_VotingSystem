<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
        ]);
        
        DB::table('roles')->insert([
            'role_name' => 'User',
            'role_slug' => 'user',
        ]);
    }
}
