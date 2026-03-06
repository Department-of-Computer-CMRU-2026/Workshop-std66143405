<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Web Development with Laravel',
                'speaker' => 'John Doe (Senior)',
                'location' => 'Room 401',
                'total_seats' => 20,
            ],
            [
                'title' => 'Advanced CSS & Glassmorphism',
                'speaker' => 'Jane Smith (Senior)',
                'location' => 'Lab 5',
                'total_seats' => 15,
            ],
            [
                'title' => 'Database Optimization',
                'speaker' => 'Mike Ross (Senior)',
                'location' => 'Online',
                'total_seats' => 30,
            ],
            [
                'title' => 'System Design Basics',
                'speaker' => 'Sarah Connor (Senior)',
                'location' => 'Room 202',
                'total_seats' => 10,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
