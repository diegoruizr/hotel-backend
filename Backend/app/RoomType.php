<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
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
     * Tipos de habitaciones que pertenecen a la acomodacion.
     */
    public function accommodations()
    {
        return $this->belongsToMany('\App\Accommodation','accommodation_room_types')->withPivot('accommodation_id','state')->withTimestamps();
    }
}
