<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 subscribers that each has one related fields.
        Subscriber::factory()
            ->count(100)
            ->hasFields(2)
            ->create();
    }
}
