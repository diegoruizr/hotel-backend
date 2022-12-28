<?php

namespace Database\Seeders;

use App\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new RoomType();
        $type->name = "Estándar";
        $type->state = 1;
        $type->created_by = 1;
        $type->save();

        $type = new RoomType();
        $type->name = "Junior";
        $type->state = 1;
        $type->created_by = 1;
        $type->save();

        $type = new RoomType();
        $type->name = "Suite";
        $type->state = 1;
        $type->created_by = 1;
        $type->save();
    }
}
