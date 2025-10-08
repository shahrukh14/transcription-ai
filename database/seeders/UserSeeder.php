<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
        ]);
        \App\Models\Admin::create([
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'email'=>'jhondoe@gmail.com',
            'password'=>Hash::make('password'),
        ]);
    }
}
