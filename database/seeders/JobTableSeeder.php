<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Job;
use App\Models\Company;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::factory()->count(10)->create([
            'company_id' => Company::inRandomOrder()->take(1)->pluck('id'),
        ]);
    }
}
