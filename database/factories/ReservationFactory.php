<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'reservation_date' => $this->faker->date,
            'return_date' => $this->faker->date,
            'is_returned' => $this->faker->boolean,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'book_id' => function () {
                return \App\Models\Book::factory()->create()->id;
            },
        ];
    }
}
