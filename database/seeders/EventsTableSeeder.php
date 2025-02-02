<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder {
    public function run() {
        Event::create([
            'name' => 'Tech Conference 2025',
            'description' => 'A leading technology conference for developers.',
            'date' => '2025-06-15'
        ]);

        Event::create([
            'name' => 'AI & Robotics Expo',
            'description' => 'An exhibition of cutting-edge AI and robotics technology.',
            'date' => '2025-09-10'
        ]);
    }
}