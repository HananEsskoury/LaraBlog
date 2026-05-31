<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Créer les catégories si elles n'existent pas ──────────────
        $categoriesData = [
            ['name' => 'Technologie', 'slug' => 'technologie', 'description' => 'Articles sur la tech'],
            ['name' => 'Culture',     'slug' => 'culture',     'description' => 'Art, musique, cinéma'],
            ['name' => 'Science',     'slug' => 'science',     'description' => 'Découvertes scientifiques'],
            ['name' => 'Voyage',      'slug' => 'voyage',      'description' => 'Destinations et aventures'],
            ['name' => 'Lifestyle',   'slug' => 'lifestyle',   'description' => 'Mode de vie'],
        ];

        foreach ($categoriesData as $cat) {
            Categorie::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // ── 2. Créer un admin si aucun n'existe ──────────────────────────
        if (!User::where('usertype', 'admin')->exists()) {
            User::create([
                'name'     => 'Admin',
                'email'    => 'admin@larablog.com',
                'password' => bcrypt('password'),
                'usertype' => 'admin',
            ]);
        }

        // ── 3. Créer des auteurs si moins de 3 existent ──────────────────
        $auteursCount = User::where('usertype', 'auteur')->count();
        if ($auteursCount < 3) {
            $auteurs = [
                ['name' => 'Marie Dupont',  'email' => 'marie@larablog.com'],
                ['name' => 'Jean Martin',   'email' => 'jean@larablog.com'],
                ['name' => 'Sofia Benali',  'email' => 'sofia@larablog.com'],
            ];
            foreach ($auteurs as $auteur) {
                User::firstOrCreate(
                    ['email' => $auteur['email']],
                    [
                        'name'     => $auteur['name'],
                        'password' => bcrypt('password'),
                        'usertype' => 'auteur',
                    ]
                );
            }
        }

        // ── 4. Créer les posts ────────────────────────────────────────────
        // 15 articles publiés
        Post::factory()->count(15)->approved()->create();

        // 5 en attente de validation
        Post::factory()->count(5)->pending()->create();

        // 3 rejetés
        Post::factory()->count(3)->rejected()->create();

        // 2 brouillons
        Post::factory()->count(2)->draft()->create();

        $this->command->info('✅ ' . Post::count() . ' posts créés avec succès.');
    }
}