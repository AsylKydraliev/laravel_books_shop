<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Category::factory(50)->has(
            Book::factory()->count(5)
        )->create();
    }
}
