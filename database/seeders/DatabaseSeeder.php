<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\listing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'salman',
            'email' => 'abbacy@gmail.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
        // Listing::create([
        //     'name' => 'abbasig',
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'NGS',
        //     'location' => 'park road ',
        //     'email' => 'email@gmail.com',
        //     'website' => 'https://ngs.com',
        //     'description' => 'lorem15 ghsh this is the nice emaikl trwe are use nfg here nio'
        // ]);


        // Listing::create([
        //     'name' => 'abbasig',
        //     'title' => 'Full Stack Engineer',
        //     'tags' => 'laravel, backend , api',
        //     'company' => 'Systems Limited',
        //     'location' => 'islamabad',
        //     'email' => 'systemlimited@gmail.com',
        //     'website' => 'https://systemslimited.com',
        //     'description' => 'lorem15 ghsh this is the nice emaikl trwe are use nfg here nio'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
