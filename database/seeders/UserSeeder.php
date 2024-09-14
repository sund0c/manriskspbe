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
            'email' => 'putu.sundika@baliprov.go.id',
            'password' => bcrypt('sundika')
        ]);
        $admin->assignRole('admin');

        $persandian = User::create([
            'name' => 'staf persandian',
            'email' => 'nonik.rahayu@baliprov.go.id',
            'password' => bcrypt('nonik')
        ]);
        $persandian->assignRole('persandian');

        $opd = User::create([
            'name' => 'nopa',
            'email' => 'nopa@baliprov.go.id',
            'password' => bcrypt('nopa')
        ]);
        $opd->assignRole('opd');
    }
}
