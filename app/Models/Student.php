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
        'age'
    ];

    protected $casts = [
        'birthdate' => 'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }
}
