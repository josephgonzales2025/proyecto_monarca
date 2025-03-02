<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'name',
        'cellphone',
        'address',
        'responsible',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
