<?php

namespace Database\Factories;

use App\Helpers\RPConstants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => preg_replace('/@example\..*/', '@test.com', $this->faker->unique()->safeEmail),
            'email_verified_at' => now(),
            'password' => '$2y$10$1y6vPrHkgWMkzBGGE7GcluqjVZwZWO/5VEJqdwI6TDEOSLZhrxQeO', // password = Abc123456
            'remember_token' => Str::random(10),
        ];
    }
}
