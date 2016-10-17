<?php

use App\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::create(['name'=>'Hamburguer']);
        ServiceType::create(['name'=>'Mexican']);
        ServiceType::create(['name'=>'Japanese']);
        ServiceType::create(['name'=>'Churros']);
        ServiceType::create(['name'=>'Kebab']);
        ServiceType::create(['name'=>'Brewery']);
        ServiceType::create(['name'=>'Soft Drinks']);
        ServiceType::create(['name'=>'Grilled Meat']);
        ServiceType::create(['name'=>'Deserts']);
        ServiceType::create(['name'=>'Thai']);
        ServiceType::create(['name'=>'Coffee']);
        ServiceType::create(['name'=>'Wraps']);
        ServiceType::create(['name'=>'International']);
        ServiceType::create(['name'=>'Vegetarian']);
        ServiceType::create(['name'=>'Healthy Food']);
        ServiceType::create(['name'=>'Sushi']);
        ServiceType::create(['name'=>'Pastel']);
        ServiceType::create(['name'=>'Crepe']);
        ServiceType::create(['name'=>'French Fries']);
        ServiceType::create(['name'=>'Small Portions']);
        ServiceType::create(['name'=>'Barbecue']);
        ServiceType::create(['name'=>'Pizza']);
        ServiceType::create(['name'=>'Italian']);
        ServiceType::create(['name'=>'Alcoholic Beverages']);
        ServiceType::create(['name'=>'Bagels']);
    }
}
