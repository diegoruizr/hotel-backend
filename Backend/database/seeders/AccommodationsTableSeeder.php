<?php

namespace Database\Seeders;

use App\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accommodation = new Accommodation();
        $accommodation->name = "Sencilla";
        $accommodation->state = 1;
        $accommodation->created_by = 1;
        $accommodation->save();

        $accommodation = new Accommodation();
        $accommodation->name = "Doble";
        $accommodation->state = 1;
        $accommodation->created_by = 1;
        $accommodation->save();

        $accommodation = new Accommodation();
        $accommodation->name = "Triple";
        $accommodation->state = 1;
        $accommodation->created_by = 1;
        $accommodation->save();

        $accommodation = new Accommodation();
        $accommodation->name = "Cuádruple";
        $accommodation->state = 1;
        $accommodation->created_by = 1;
        $accommodation->save();
    }
}
