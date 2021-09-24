<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    public function testUserCreation()
    {
      User::factory()->create([
          'firstName' => 'Kevin'
      ]);
      $this->assertDatabaseHas('users', ['firstName' => 'Kevin']);
    }
}