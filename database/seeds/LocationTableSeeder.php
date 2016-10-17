<?php

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $faker = Factory::create();
        $trucks = \App\Truck::all();
        foreach($trucks as $truck)
        {
            for($i = 0;$i <= $faker->numberBetween(2,10); $i++)
            {
                $creation = $faker->dateTimeThisYear('now');
                //CURITIBA COORD
                $location = \App\Location::create(['latitude'=> $faker->latitude(-25.614953, -25.379441), 'longitude'=> $faker->longitude(-49.386289, -49.195554),'created_at'=> $creation]);
                $truck->locations()->save($location);
                if($truck->latestlocation_id == null || ($truck->latestlocation != null ? $creation >= $truck->latestlocation->created_at : false))
                {
                    $truck->latestlocation_id = $location->id;
                    $truck->save();
                }
            }
        }
    }
}
