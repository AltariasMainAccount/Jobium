<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

use Tests\TestCase;
use App\Models\User;
use App\Models\Job;
use App\Models\Company;

class DatabaseTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function user_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('users', [
            'id',
            'name', 
            'email', 
            'password',
        ]), 1);
    }

    /** @test */
    public function company_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('companies', [
            'id',
            'name', 
            'branch', 
        ]), 1);
    }

    /** @test */
    public function job_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('jobs', [
            'id',
            'name',
            'company_id'
        ]), 1);
    }

    /** @test */
    public function testJobCreation()
    {
        Job::factory()->create([
            'name' => 'Senior Programmer'
        ]);
        $this->assertDatabaseHas('jobs', ['name' => 'Senior Programmer']);
    }

    /** @test */
    public function testUserCreation()
    {
        User::factory()->create([
            'name' => 'Kevin'
        ]);
        $this->assertDatabaseHas('users', ['name' => 'Kevin']);
    }

    /** @test */
    public function testCompanyCreation()
    {
        Company::factory()->create([
            'name' => 'Test Company'
        ]);
        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
    }

    /** @test */
    public function testManyToMany_UserToCompany() 
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        DB::table('company_user')->insert([
            'company_id' => $company->id,
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->companies);
    }


    /** @test */
    public function testManyToMany_CompanyToUser() 
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();

        DB::table('company_user')->insert([
            'company_id' => $company->id,
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $company->users);
    }


    /** @test */
    public function testOneToMany_JobToCompany()
    {
        $company = Company::factory()->create(); 
        $job = Job::factory()->create(['company_id' => $company->id]);

        $this->assertEquals(1, $company->jobs->count());
    }

    /** @test */
    public function testOneToMany_CompanyToJob()
    {
        $company = Company::factory()->create(); 
        $job = Job::factory()->create(['company_id' => $company->id]);

        $this->assertGreaterThan(1, $job->company->count());     
    }
}