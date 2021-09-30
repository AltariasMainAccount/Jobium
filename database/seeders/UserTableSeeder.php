<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Company;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        foreach (User::all() as $user) {
            $companies = Company::inRandomOrder()->take(rand(1,10))->pluck('id');
            $user->companies()->attach($companies);
        }
    }
}
