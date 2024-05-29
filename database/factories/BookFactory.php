<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title'=> fake()->title,
            'author'=>fake()->name,
            'publisher' =>fake()->company,
            'page_count' => fake()->numberBetween(50, 1000),
        ];
    }
}
