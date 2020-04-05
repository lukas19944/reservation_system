<?php

use App\Equipment;
use Illuminate\Database\Seeder;

class EquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<4;$i++)
        Equipment::create([
            'type'=>'Komputer',
            'model'=>'Asus',
            'designation'=>$i,
            'buy_date'=>'2013',
            'price'=>'2500',
            'description'=>'Laptop',

        ]);
    }
}
