<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'pahit_config';
    protected $fillable = [
        'accKey', 'config'
    ];
}
