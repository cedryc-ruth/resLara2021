<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AgentSeeder::class,
            ArtistSeeder::class,
            TypeSeeder::class,
            LocalitySeeder::class,
            RoleSeeder::class,
            LocationSeeder::class,
            ShowSeeder::class,
            RepresentationSeeder::class,
            ArtistTypeSeeder::class,
            ArtistTypeShowSeeder::class,
            UserLocationSeeder::class,
        ]);
    }
}
