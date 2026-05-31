<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(rand(4, 8));

        return [
            'title'            => $title,
            'description'      => $this->faker->paragraphs(rand(3, 6), true),
            'image'            => null,
            'slug'             => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'status'           => $this->faker->randomElement(['approved', 'pending', 'rejected']),
            'rejection_reason' => null,
            'reviewed_by'      => null,
            'reviewed_at'      => null,
            'vues'             => $this->faker->numberBetween(0, 1000),
            'user_id'          => User::where('usertype', 'auteur')
                                      ->inRandomOrder()
                                      ->value('id'),
            'categorie_id'     => Categorie::inRandomOrder()->value('id'),
            'created_at'       => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    // ── États ──────────────────────────────────────────

    public function approved(): static
    {
        return $this->state(function () {
            $admin = User::where('usertype', 'admin')->value('id');
            return [
                'status'      => 'approved',
                'reviewed_by' => $admin,
                'reviewed_at' => now(),
            ];
        });
    }

    public function pending(): static
    {
        return $this->state([
            'status'      => 'pending',
            'reviewed_by' => null,
            'reviewed_at' => null,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(function () {
            $admin = User::where('usertype', 'admin')->value('id');
            return [
                'status'           => 'rejected',
                'reviewed_by'      => $admin,
                'reviewed_at'      => now(),
                'rejection_reason' => $this->faker->sentence(),
            ];
        });
    }

    public function draft(): static
    {
        return $this->state([
            'status'      => 'draft',
            'reviewed_by' => null,
            'reviewed_at' => null,
        ]);
    }
}