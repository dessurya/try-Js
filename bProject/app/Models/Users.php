<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Model
{
    use Notifiable;
	protected $table = 'pahit_users';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'code_of_api', 'code_of_api_time'
    ];
}