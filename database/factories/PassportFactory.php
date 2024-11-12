<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Passport;

class PassportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Passport::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->word(),
            'file_name' => $this->faker->word(),
            'is_data_correct' => $this->faker->boolean(),
            'is_data_entered' => $this->faker->boolean(),
            'passport_expiry_date' => $this->faker->date(),
            'visa_expiry_date' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'is_passport' => $this->faker->boolean(),
            'is_visa' => $this->faker->boolean(),
            'is_photo' => $this->faker->boolean(),
            'is_no_file_uploaded' => $this->faker->boolean(),
            'issue' => $this->faker->word(),
            'verify_count' => $this->faker->numberBetween(-10000, 10000),
            're_entry' => $this->faker->boolean(),
            'verifier_id' => $this->faker->numberBetween(-10000, 10000),
            'verifier1_id' => $this->faker->numberBetween(-10000, 10000),
            'verifier2_id' => $this->faker->numberBetween(-10000, 10000),
            'verifier1' => $this->faker->numberBetween(-10000, 10000),
            'verifier2' => $this->faker->numberBetween(-10000, 10000),
            'is_issue' => $this->faker->boolean(),
        ];
    }
}
