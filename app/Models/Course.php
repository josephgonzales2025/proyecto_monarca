<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
