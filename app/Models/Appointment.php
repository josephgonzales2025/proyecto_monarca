<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_id',
        'local_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'is_paid'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'string'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function local(){
        return $this->belongsTo(Local::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
