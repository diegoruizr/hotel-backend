<?php

namespace Database\Seeders;


use App\Accommodation;
use App\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationRoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Estándar
        $room_type= RoomType::find(1);
        $accommodations = new Accommodation();
        $accommodations = $accommodations->whereIn('id',[1,2])->get();
        foreach ($accommodations as $accommodation) {
            $room_type->accommodations()->attach($accommodation->id,[
                'state'=>1, 
                'created_by'=>1
            ]);
        }

        //Junior
        $room_type= RoomType::find(2);
        $accommodations = new Accommodation();
        $accommodations = $accommodations->whereIn('id',[3,4])->get();
        foreach ($accommodations as $accommodation) {
            $room_type->accommodations()->attach($accommodation->id,[
                'state'=>1, 
                'created_by'=>1
            ]);
        }

        //Suite
        $room_type= RoomType::find(3);
        $accommodations = new Accommodation();
        $accommodations = $accommodations->whereIn('id',[1,2,3])->get();
        foreach ($accommodations as $accommodation) {
            $room_type->accommodations()->attach($accommodation->id,[
                'state'=>1, 
                'created_by'=>1
            ]);
        }
    }
}
