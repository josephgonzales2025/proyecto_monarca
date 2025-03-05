<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'dni',
        'email',
        'cellphone',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
