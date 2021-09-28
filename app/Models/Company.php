<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // The Table to access
    protected $table = 'companies';

    // The Primary Key
    protected $primaryKey = 'company_id';

    // Disabling timestamping
    public $timestamps = false;

    protected $fillable = [
        'name',
        'branch',
    ];

    protected $casts = [
        'users' => 'array'
    ];

    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
