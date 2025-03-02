<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = [
        'name', 
        'dni', 
        'birthdate',
        'age',
        'local_id'
    ];

    protected $casts = [
        'birthdate' => 'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
