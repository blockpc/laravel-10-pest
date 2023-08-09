<?php

declare(strict_types=1);

namespace Packages\Book\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Packages\Book\App\Models\Book;

final class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->sentences(5, true),
            'author' => fake()->name(),
        ];
    }
}
