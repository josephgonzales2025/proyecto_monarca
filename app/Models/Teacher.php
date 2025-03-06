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
        'specialty',
        'days',
        'photo'
    ];

    protected $casts = [
        'birthdate' => 'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function courses(){
        return $this->hasMany(Course::class);
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
