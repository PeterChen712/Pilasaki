<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;

class MaterialCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Pengenalan Sampah', 'slug' => 'pengenalan-sampah'],
            ['name' => 'Pengelolaan Sampah', 'slug' => 'pengelolaan-sampah'],
            ['name' => 'Daur Ulang', 'slug' => 'daur-ulang'],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan'],
        ];

        foreach ($categories as $category) {
            MaterialCategory::create($category);
        }
    }
}