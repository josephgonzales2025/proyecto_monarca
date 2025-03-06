<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    
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
