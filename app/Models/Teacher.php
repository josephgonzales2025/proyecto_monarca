<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'dni',
        'birthdate',
        'age',
        'local_id',
        'specialty',
        'days',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function getBirthdateAttribute($value){
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s');
    }
}
