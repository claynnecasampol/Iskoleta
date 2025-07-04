<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SDPO extends Authenticatable
{
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'org_id',
        'position',
        'contact',
    ];

    protected $hidden = [
        'password',
    ];
}