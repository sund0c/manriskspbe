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
            'name' => 'persandian',
            'email' => 'persandian@baliprov.go.id',
            'password' => bcrypt('nonik'),
            'opd' => 1

        ]);
        $persandian->assignRole('persandian');



        $opd = User::create([
            'name' => 'disdikpora',
            'email' => 'disdikpora@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 12
        ]);
        $opd = User::create([
            'name' => 'diskominfos',
            'email' => 'diskominfos@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 22
        ]);
        $opd = User::create([
            'name' => 'bkpsdm',
            'email' => 'bkpsdm@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 1
        ]);
        $opd = User::create([
            'name' => 'pkp',
            'email' => 'pkp@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 2
        ]);
        $opd = User::create([
            'name' => 'rsj',
            'email' => 'rsj@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 13
        ]);
        $opd = User::create([
            'name' => 'rsbm',
            'email' => 'rsbm@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 23
        ]);
        $opd = User::create([
            'name' => 'rsmata',
            'email' => 'rsmata@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 24
        ]);
        $opd = User::create([
            'name' => 'inspektorat',
            'email' => 'inspektorat@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 6
        ]);
        $opd = User::create([
            'name' => 'dispar',
            'email' => 'dispar@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 7
        ]);
        $opd = User::create([
            'name' => 'kesbangpol',
            'email' => 'kesbangpol@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 8
        ]);
        $opd = User::create([
            'name' => 'pmd',
            'email' => 'pmd@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 9
        ]);
        $opd = User::create([
            'name' => 'dislautkan',
            'email' => 'dislautkan@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 10
        ]);
        $opd = User::create([
            'name' => 'bapenda',
            'email' => 'bapenda@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 11
        ]);
        $opd = User::create([
            'name' => 'pma',
            'email' => 'pma@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 5
        ]);
        $opd = User::create([
            'name' => 'pupr',
            'email' => 'pupr@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 4
        ]);
        $opd = User::create([
            'name' => 'bpbd',
            'email' => 'bpbd@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 14
        ]);
        $opd = User::create([
            'name' => 'bpkad',
            'email' => 'bpkad@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 15
        ]);
        $opd = User::create([
            'name' => 'bptp',
            'email' => 'bptp@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 16
        ]);
        $opd = User::create([
            'name' => 'disnakeresdm',
            'email' => 'disnakeresdm@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 17
        ]);
        $opd = User::create([
            'name' => 'disbud',
            'email' => 'disbud@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 19
        ]);
        $opd = User::create([
            'name' => 'dinkes',
            'email' => 'dinkes@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 18
        ]);
        $opd = User::create([
            'name' => 'sekwan',
            'email' => 'sekwan@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 21
        ]);
        $opd = User::create([
            'name' => 'bsmkp',
            'email' => 'bsmkp@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 3
        ]);
        $opd = User::create([
            'name' => 'disperindag',
            'email' => 'disperindag@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 20
        ]);
        $opd = User::create([
            'name' => 'birohukum',
            'email' => 'birohukum@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 26
        ]);
        $opd = User::create([
            'name' => 'biroorg',
            'email' => 'biroorg@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 27
        ]);
        $opd = User::create([
            'name' => 'biroumum',
            'email' => 'biroumum@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 29
        ]);
        $opd = User::create([
            'name' => 'biropem',
            'email' => 'biropem@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 28
        ]);
        $opd = User::create([
            'name' => 'bapeda',
            'email' => 'bapeda@baliprov.go.id',
            'password' => bcrypt('12345'),
            'opd' => 25
        ]);
        $opd->assignRole('opd');
    }
}
