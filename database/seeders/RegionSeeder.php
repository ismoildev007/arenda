<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'Qoraqalpogʻiston Respublikasi'],
            ['name' => 'Andijon viloyati'],
            ['name' => 'Buxoro viloyati'],
            ['name' => 'Jizzax viloyati'],
            ['name' => 'Qashqadaryo viloyati'],
            ['name' => 'Navoiy viloyati'],
            ['name' => 'Namangan viloyati'],
            ['name' => 'Toshkent shahri'],
            ['name' => 'Samarqand viloyati'],
            ['name' => 'Sirdaryo viloyati'],
            ['name' => 'Toshkent viloyati'],

        ];

        DB::table('regions')->insert($regions);

    }
}
