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
        // Create 20 subscribers that each has one related fields.
        Subscriber::factory()
            ->count(20)
            ->hasFields(2)
            ->create();
    }
}
