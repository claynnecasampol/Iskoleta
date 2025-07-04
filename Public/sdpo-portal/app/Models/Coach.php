<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'sport',
        'org_id',
        'contact',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
