<?php

use App\ServiceType;
use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class FoodTrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
		$status = ['available', 'transit', 'unavailable','denied'];
        $faker = Factory::create();
        for ($i=0; $i < $faker->numberBetween(50,150); $i++) {
        	        $truck = new \App\Truck();
			        $truck->name = 'Foodtruck '. $i;
			        $truck->identification = '13.968.962/0001-80';
			        $truck->phone = $faker->phoneNumber;
			        $truck->address = $faker->address;
			        $truck->lets_negotiate = $faker->boolean;
			        $truck->delivery_bike = $faker->boolean;
			        $truck->delivery_motorcycle = $faker->boolean;
			        $truck->formal_name = 'VIZAD SOLUCOES LTDA';
			        $truck->logo = '/avatars/4/b5090a134483b3797b3c45850405ecd6.jpeg';
			        $enabled = $faker->boolean(30);
			        $truck->enabled = $enabled;
			        if(!$enabled)
			        {
			        	$truck->status = $status[$faker->numberBetween(0,3)];
			        }else{
			        	$truck->status = $status[$faker->numberBetween(2,3)];
			        }
			        $truck->service_type_id = ServiceType::all()->random()->id;
			        $truck->save();
        			$truck->users()->attach(1);
        }


    }
}
