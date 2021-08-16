<?php

namespace Database\Factories;

use App\Models\Midwife;
use Illuminate\Database\Eloquent\Factories\Factory;

class MidwifeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Midwife::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'qualifications'=>$this->faker->randomElement($array = array ('Junior','intermediate','Senior')),
             'working_status'=>$this->faker->randomElement($array = array ('Fulltime','Parttime','Unemployed')),
             'user_id'=>$this->faker->randomDigitNot(0),
        ];
    }
}
