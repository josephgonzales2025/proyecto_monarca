<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'ruc',
        'name',
        'address',
        'phone',
        'email',
        'contact',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
