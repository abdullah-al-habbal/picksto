<?php

declare(strict_types=1);

namespace Modules\Website\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Website\Models\WebsitePageModel;

final class WebsitePageModelFactory extends Factory
{
    protected $model = WebsitePageModel::class;

    public function definition(): array
    {
        $slug = fake()->unique()->slug(2);

        return [
            'slug' => $slug,
            'title' => [
                'ar' => fake('ar_SA')->words(3, true),
                'en' => fake()->words(3, true),
            ],
            'content' => [
                'ar' => fake('ar_SA')->optional(0.8)->paragraphs(3, true),
                'en' => fake()->optional(0.8)->paragraphs(3, true),
            ],
            'meta_description' => fake()->optional(0.7)->sentence(),
            'is_active' => fake()->boolean(90),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => false,
        ]);
    }
}
