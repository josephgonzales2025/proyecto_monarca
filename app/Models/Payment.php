<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'amount',
        'paymentDate',
        'paymentStatus'
    ];

    protected $casts = ['paymentDate'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
