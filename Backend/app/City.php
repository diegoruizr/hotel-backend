<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
     * Cuidad tiene muchos Hoteles.
     */
    public function hotels()
    {
        return $this->hasMany('\App\Hotel');
    }
}
