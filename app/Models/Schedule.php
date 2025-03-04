<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'teacher_id',
        'course_id',
        'days',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'string',
        'end_time' => 'string'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
