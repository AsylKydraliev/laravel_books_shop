<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    // show books
    // edit books add, delete
    // filter
    // component
    /**
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(100,3000),
            'image' => $this->faker->imageUrl(400, 300, 'abstract'),
            'author_id' => Author::all()->random(),
        ];
    }
}
