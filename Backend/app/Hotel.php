<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','city_id','address','nit','number_room','state','created_by','updated_by'];

    // Se agrega Append para nombre de la cuidad
    protected $appends = ['city_name'];


    //METODOS
    

     /**
     * Hoteles que pertenecen a una cuidad.
     */
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    /**
     * Hoteles que pertenecen a la Pivote [Acomodacion con tipo de habitacion].
     */
    public function accomodationRoomTypes()
    {
        return $this->belongsToMany('\App\AccommodationRoomType','hotel_accommodation_room_types')->withPivot('accommodation_room_type_id','state','quantity')->withTimestamps();
    }


    /**
     * Append Nombre Cuidad.
     */
    public function getCityNameAttribute()
    {
        $city = new City();
        $city= $city->select('name')->where('id',$this->city_id)->first();
        return $city->name;
    }
}
