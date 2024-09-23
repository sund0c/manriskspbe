<?php

namespace Database\Seeders;

use App\Models\Itemannex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemAnnexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Itemannex::create([
            'nama' => '5.1 Policies for information security',
            'domain' => 1
        ]);
        Itemannex::create([
            'nama' => '5.2 Information Security Roles and Responsibilities',
            'domain' => 1
        ]);
        Itemannex::create([
            'nama' => '6.1 Screening',
            'domain' => 2
        ]);
        Itemannex::create([
            'nama' => '6.2 Terms and conditions of employment',
            'domain' => 2
        ]);
        Itemannex::create([
            'nama' => '7.1 Physical security perimeter',
            'domain' => 3
        ]);
        Itemannex::create([
            'nama' => '7.2 Physical entry controls',
            'domain' => 3
        ]);
        Itemannex::create([
            'nama' => '8.1 User Endpoint Devices',
            'domain' => 4
        ]);
        Itemannex::create([
            'nama' => '8.2 Privileged Access Rights',
            'domain' => 4
        ]);
    }
}
