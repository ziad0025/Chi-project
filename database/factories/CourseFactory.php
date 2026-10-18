<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(3),
            'description'  => $this->faker->paragraph(2),
            'grade'        => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'price'        => $this->faker->randomElement([0, 150, 299, 450, 600]),
            'is_published' => $this->faker->boolean(80), // 80% من الكورسات هتكون منشورة
            'image'    => null, // هيستخدم الصورة الاحتياطية المحددة في الـ Blade
        ];
    }
}
