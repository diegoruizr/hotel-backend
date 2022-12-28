<?php

namespace App;

use App\Accommodation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationRoomType extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['accommodation_id','room_type_id','state','created_by','updated_by'];



    //METODOS
    

    /**
     * Pivote [Acomodacion con tipo de habitacion] que pertenecen al hotel.
     */
    public function hotels()
    {
        return $this->belongsToMany('\App\Hotel','hotel_accommodation_room_types')->withPivot('hotel_id','state','quantity')->withTimestamps();
    }

}
