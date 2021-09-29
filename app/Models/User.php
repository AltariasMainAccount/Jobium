<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Uses clause - This model has API tokens, has a factory and is notifiable
    use HasApiTokens, HasFactory, Notifiable;

    // The Table to access
    protected $table = 'users';

    // The Primary Key
    protected $primaryKey = 'user_id';

    // Disabling timestamping
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'companies',
        'hasApiAccess'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'companies' => 'array'
    ];

    // Relations to other models

    public function companies() {
        return $this->hasMany(Company::class);
    }

}
