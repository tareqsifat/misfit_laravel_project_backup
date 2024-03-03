<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Subscriber::class;
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
