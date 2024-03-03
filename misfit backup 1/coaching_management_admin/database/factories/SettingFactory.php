<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
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
            'title' => $this->faker->title(),
            'value' => $this->faker->title(),
        ];
    }
}
