<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'plane_name' => 'Garuda Indonesia',
                'origin' => 'Jakarta',
                'destination' => 'Bali',
                'departure' => '2024-05-01 08:00:00',
                'price' => 1500000,
                'stock' => 100
            ],
            [
                'plane_name' => 'Lion Air',
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'departure' => '2024-05-02 09:00:00',
                'price' => 800000,
                'stock' => 150
            ],
            [
                'plane_name' => 'AirAsia',
                'origin' => 'Jakarta',
                'destination' => 'Medan',
                'departure' => '2024-05-03 10:00:00',
                'price' => 1200000,
                'stock' => 120
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
