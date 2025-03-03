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
        'end_time',
        'photo'
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

    public function uploadPhoto($photo)
    {
        if ($photo) {
            // Guarda la foto en el directorio 'photos' dentro del almacenamiento público
            $path = $photo->store('photos', 'public');

            // Actualiza la ruta de la foto en el modelo
            $this->photo = $path;

            // Guarda el modelo con la nueva ruta de la foto
            $this->save();

            return $path;
        }

        return null;
    }
}
