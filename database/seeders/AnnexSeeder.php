<?php

namespace Database\Seeders;

use App\Models\Annex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Annex::create([
            'nama' => '5. Organisational Controls'
        ]);
        Annex::create([
            'nama' => '6. People Controls'
        ]);
        Annex::create([
            'nama' => '7. Physical Controls'
        ]);
        Annex::create([
            'nama' => '8. Technology Controls'
        ]);

    }
}
