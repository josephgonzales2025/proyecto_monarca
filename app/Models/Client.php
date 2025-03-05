<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['client_type'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function individual(){
        return $this->hasOne(Individual::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
}
