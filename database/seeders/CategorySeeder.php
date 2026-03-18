<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
    [
        'id' => 1,
        'name' => 'صحي',
        'slug' => 'health',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 2,
        'name' => 'تكنولوجيا',
        'slug' => 'technology',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 3,
        'name' => 'علمي',
        'slug' => 'science',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 4,
        'name' => 'مناخ',
        'slug' => 'climate',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 5,
        'name' => 'عاطفي',
        'slug' => 'emotional',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
}
}