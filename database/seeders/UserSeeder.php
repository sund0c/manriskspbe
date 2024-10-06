<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'sundika',
            'email' => 'sundika@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 1
        ]);
        $admin->assignRole('admin');

        $persandian = User::create([
            'name' => 'persandian',
            'email' => 'persandian@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 1

        ]);
        $persandian->assignRole('persandian');
    }
}
