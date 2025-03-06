<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Individual extends Model
{

    use HasFactory;

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
