<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use App\Models\Job;

class JobTest extends TestCase
{
    use DatabaseTransactions;
    public function testJobCreation()
    {
      Job::factory()->create([
          'name' => 'Senior Programmer'
      ]);
      $this->assertDatabaseHas('jobs', ['name' => 'Senior Programmer']);
    }
}