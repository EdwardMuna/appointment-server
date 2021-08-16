<?php

namespace Database\Factories;

use App\Models\Mother;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MotherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mother::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'date_of_birth'=>Carbon::now(),
            'gravida'=>$this->faker->randomDigitNot(0),
            'user_id'=>$this->faker->randomDigitNot(0),
        ];
    }
}
