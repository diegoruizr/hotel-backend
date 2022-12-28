<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','state','created_by','updated_by'];


    //METODOS
    

    /**
     * Acomodaciones que pertenecen al tipo de habitacion.
     */
    public function roomTypes()
    {
        return $this->belongsToMany('\App\RoomType','accommodation_room_types')->withPivot('room_type_id','state')->withTimestamps();
    }
}
