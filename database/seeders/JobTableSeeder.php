<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Job;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::factory()->count(10)->create();
    }
}
