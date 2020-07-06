<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Model
{
    use Notifiable;
	protected $table = 'pahit_customer';
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'point'
    ];
    protected $hidden = [
        'password', 'code_of_api', 'code_of_api_time'
    ];
}