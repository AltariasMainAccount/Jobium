<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    
    // The Table to access
    protected $table = 'jobs';

    // The Primary Key
    protected $primaryKey = 'job_id';

    // Disabling timestamping
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
