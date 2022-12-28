<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\City;
use App\RoomType;
use App\Accommodation;
use App\AccommodationRoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Mostrar una lista de hoteles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotels = new Hotel();
        if ($request->name != '') {
            $hotels = $hotels
            ->where('hotels.name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->nit != '') {
            $hotels = $hotels
            ->where('hotels.nit', 'LIKE', '%'.$request->nit.'%');
        }
        $hotels = $hotels->orderBy('id', 'ASC')->paginate(10);
        return response()->json([
            "hotels" => $hotels
        ]);
    }

    
    /**
     * Detalle de las cuidades.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities()
    {
        $cities = new City();
        $cities= $cities->orderBy('name', 'ASC')->get();
        return response()->json(['cities' => $cities]);
    }

    /**
     * Metodo que devuelve codigo para nit unico.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uniqueNit(Request $request){
        $hotel = new Hotel();
        $hotel = $hotel->where('nit',$request->input('nit'))->first();
        if($hotel != null && $hotel != "" ){
            return response()->json([
                'status' => 501,
            ]);
        }else {
            return response()->json([
                'status' => 200,
           ]);
        }
    }


    /**
     * Crear Hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validacion = true;
        $hotel = new Hotel();
        $hotel->city()->associate($request->hotel['city_id']);
        $hotel->name = $request->hotel['name'];
        $hotel->address = $request->hotel['address'];
        $hotel->nit = $request->hotel['nit'];
        $hotel->number_room = $request->hotel['number_room'];
        $hotel->state = 1;
        $hotel->created_by = request()->header('user');
        $hotel->created_at = Carbon::now();
        if(!$hotel->save()){
            $validacion = false;
            App::abort(106, 'Error al crear el hotel');
        }
        if($validacion)
        {
            return response()->json([
                "message" => "Hotel creado correctamente",
                "hotel" => $hotel,
                "valid"   => 0
            ],200);
        }
    }

    /**
     * Mostrar un hotel especifico
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->id)->first();

        $cities = new City();
        $cities= $cities->orderBy('name', 'ASC')->get();

        //$request->request->add(['subscriber'=>$subscriber->name]);
        return response()->json([
            'hotel' => $hotel,
            'cities' => $cities
        ]);
    }


    /**
     * Actualizar un hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->hotel['id'])->firstOrfail();
        
        $hotel->city()->associate($request->hotel['city_id']);
        $hotel->name = $request->hotel['name'];
        $hotel->address = $request->hotel['address'];
        $hotel->nit = $request->hotel['nit'];
        $hotel->number_room = $request->hotel['number_room'];
        $hotel->state = 1;
        $hotel->updated_by = request()->header('user');
        $hotel->updated_at = Carbon::now();
        $hotel->save();

        return response()->json([
            'message' => 'Actualizacion correcta de hotel',
            "valid"   => 0
        ]);
    }

    /**
     * Actualizar un estado de un Hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request)
    {
        $hotel = new Hotel();
        $hotel = $hotel->where('id', $request->id)->firstOrfail();
        $hotel->state = $request->new_state;
        $hotel->updated_by = request()->header('user');
        $hotel->updated_at = Carbon::now();
        $mensaje= "";
        if($hotel ->save()){
            $mensaje="Estado Cambiado Correctamente";
        }
        else{
            $mensaje="Error al Cambiar el Estado";
        }
        return response()->json(['message' => $mensaje]);
    }

    /**
     * Mostrar Assignaciones de tipos de habitacion
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRoomTypes(Request $request){
        
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->id)->first();

        $room_types = new RoomType();
        $room_types = $room_types->get();
        return response()->json([
            'room_types' => $room_types,
            'number_room' => $hotel->number_room,
            'name_hotel' => $hotel->name
        ]);
    }

    /**
     * Mostrar Acomodaciones
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAccommodations(Request $request){
        $array = array();
        $room_type = new RoomType();
        $room_type = $room_type->where('id',$request->id)->first();
        
        $pivot = $room_type->accommodations()->select('accommodation_room_types.id as id_pivot')->wherePivot('state', 1)->get();
        
        foreach ($pivot as $key) {
            $accommodation = new Accommodation();
            $accommodation= $accommodation->select('name')->where('id',$key['pivot']->accommodation_id)->first();
            array_push($array, [
                "pivot_id" => $key->pivot_id,
                "name" => $accommodation->name,
                "id" => $key['pivot']->accommodation_id
            ]);
        }
        return response()->json([
            'accommodations' => $array
        ]);
    }

    /**
     * Asignar habitaciones al Hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function assing(Request $request){
        $object = $request->object;

        $hotel = new Hotel();
        $hotel = $hotel->where('id',$object['hotel_id'])->first();
        $hotel->accomodationRoomTypes()->detach();
        foreach ($object['tableData'] as $key ) {

            $room_type = new RoomType();
            $room_type = $room_type->where('id',$key['room_type_id'])->first();
    
            $pivot_accommodation_room_type = $room_type->accommodations()->select('accommodation_room_types.id as id_pivot')->wherePivot('accommodation_room_types.accommodation_id', $key['accommodation_id'])->wherePivot('accommodation_room_types.state', 1)->first();

            //$result = $hotel->accomodationRoomTypes()->where('hotel_accommodation_room_types.hotel_id',$hotel->id)->updateExistingPivot($pivot_accommodation_room_type['id_pivot'],['state'=>1,'quantity'=>$key['quantity']]);
            
            //if($result == 0)
            //{
            $hotel->accomodationRoomTypes()->attach($pivot_accommodation_room_type['id_pivot'],['state'=>1,'quantity'=>$key['quantity']]);
            //}
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }


    /**
     * Mostrar Assignaciones de habitaciones para el hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAssing(Request $request){
        $array = [];
        $count = 0;
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->id)->first();

        $pivot = $hotel->accomodationRoomTypes()->select('hotel_accommodation_room_types.id as id_pivot')->wherePivot('hotel_accommodation_room_types.state', 1)->get();
        foreach ($pivot as $key) {
            $accommodarionRoomTypes = new AccommodationRoomType();
            $accommodarionRoomTypes = $accommodarionRoomTypes->where('id',$key['pivot']->accommodation_room_type_id)->first();
            
            $accommodation = new Accommodation();
            $accommodation= $accommodation->select('name')->where('id',$accommodarionRoomTypes['accommodation_id'])->first();

            $room_types = new RoomType();
            $room_types = $room_types->select('name')->where('id',$accommodarionRoomTypes['room_type_id'])->first();
            
            $temporal = array(
                "accommodation_id" => $accommodarionRoomTypes->accommodation_id,
                "accommodation_name" => $accommodation->name,
                "room_type_id" => $accommodarionRoomTypes->room_type_id,
                "room_type_name" => $room_types->name,
                "quantity" => $key['pivot']->quantity
            );
            $count = $count + $key['pivot']->quantity;
            array_push($array, $temporal);
        }
        return response()->json([
            'tableData' => $array,
            'total' => $count
        ]);
    }
}
