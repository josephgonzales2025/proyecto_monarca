<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_date'
    ];

    protected $casts = ['enrollment_date'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function getEnrollmentDateAttribute($value){
        return Carbon::parse($value)->format('d/m/Y');
    }
}
