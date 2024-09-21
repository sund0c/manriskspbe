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
            'password' => bcrypt('sundika'),
            'opd' => 1
        ]);
        $admin->assignRole('admin');

        $persandian = User::create([
            'name' => 'nonik',
            'email' => 'nonik@baliprov.go.id',
            'password' => bcrypt('nonik'),
            'opd' => 1

        ]);
        $persandian->assignRole('persandian');

        $opd = User::create([
            'name' => 'nopa',
            'email' => 'nopa@baliprov.go.id',
            'password' => bcrypt('nopa'),
            'opd' => 3
        ]);
        $opd->assignRole('opd');
    }
}
