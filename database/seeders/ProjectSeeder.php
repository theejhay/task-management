<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {

        DB::table('projects')->delete();

        DB::table('projects')->insert([
            ['title' => 'Web Scraper',
            'description' => 'Web Scraper Project',
            'created_at' => now(),
            'updated_at' => now(),
        ],
            [
                'title' => 'An event-alert system',
                'description' => 'An event-alert system using Meetup and Eventbrite APIs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'A gift recommendation app',
                'description' => 'A gift recommendation app project for Citizens',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'A site for bartering and trading',
                'description' => 'A site for bartering and trading Project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
