<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'status',
        'teacher_id',
        'local_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function local(){
        return $this->belongsTo(Local::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}
