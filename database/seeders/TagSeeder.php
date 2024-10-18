<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\User;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory(10)->create();

        $userIds = User::pluck('id')->toArray();

        // Récupérer tous les customers
        $tags = Tag::all();

        // Parcourir tous les customers et leur assigner un user_id aléatoire existant
        foreach ($tags as $tag) {
            $tag->user_id = $userIds[array_rand($userIds)];
            $tag->save();
        }
    }
}
