<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Company;
use App\Models\User;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(10)->create();

        foreach (Company::all() as $company) {
            $users = User::inRandomOrder()->take(rand(1,10))->pluck('id');
            $company->users()->attach($users);
        }
    }
}
