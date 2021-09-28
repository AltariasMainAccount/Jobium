<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Uses clause - This model has a factory and is notifiable
    use HasFactory, Notifiable;

    // The Table to access
    protected $table = 'users';

    // The Primary Key
    protected $primaryKey = 'user_id';

    // Disabling timestamping
    public $timestamps = false;

    // Fillable content - Content in the DB that is mass assignable
    protected $fillable = [
        'firstName',
        'lastName',
        'contact_email',
        'companies'
    ];

    // Casting companies from json to array // Working around SQLITE not having arrays
    protected $casts = [
        'companies' => 'array'
    ];

    // Relations to other models

    public function companies() {
        return $this->hasMany(Company::class);
    }

}
