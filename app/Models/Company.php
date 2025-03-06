<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'client_id',
        'company_name',
        'ruc',
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
