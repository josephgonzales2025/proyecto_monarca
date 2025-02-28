<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'approximate_hours'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
