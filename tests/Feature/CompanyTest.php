<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use App\Models\Company;

class CompanyTest extends TestCase
{
    use DatabaseTransactions;
    public function testCompanyCreation()
    {
      Company::factory()->create([
          'name' => 'Test Company'
      ]);
      $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
    }
}