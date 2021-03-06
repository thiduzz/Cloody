<?php

use App\Permission;
use App\Role;
use App\Truck;
use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Laravel\Passport\PersonalAccessClient;

use Laravel\Passport\ClientRepository;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $clients;

    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    public function run()
    {


        Model::unguard();
        $faker = Factory::create();
        $slug = SlugService::createSlug(User::class, 'slug', substr(bcrypt('Thiago Mello'.Carbon::now()->toDateTimeString()),0,20), ['unique' => true]);
        $user = new User();
        $user->name = 'Thiago Mello';
        $user->email = 'thiago.mello@vizad.com.br';
        $user->password = bcrypt("thithi");
        $user->hometown = 'Curitiba';
        $user->age = 26;
        $user->avatar = '';
        $user->slug = $slug;
        $user->save();

        $this->clients->create(
            $user->id, 'Web Client', env('APP_URL'),false, true
        )->makeVisible('secret');

        $this->clients->create(
            $user->id, 'Mobile Client', env('APP_URL'),true, true
        )->makeVisible('secret');


        $god_view = Permission::create(array('name'=>'god_view', 'display_name'=> 'God View'));
        $manage_users = Permission::create(array('name'=>'manage_users', 'display_name'=> 'Manage Users'));
        $manage_oauth = Permission::create(array('name'=>'oauth_admin', 'display_name'=> 'Manage OAuth'));
        $manage_truck = Permission::create(array('name'=>'manage_truck', 'display_name'=> 'Manage Truck'));

        $role = Role::create(array('name'=>'customer','display_name'=>'Customer'));

        $role = Role::create(array('name'=>'trucker','display_name'=>'Trucker'));
        $role->permissions()->sync(array($manage_truck->id));

        $role = Role::create(array('name'=>'moderator','display_name'=>'Moderator'));
        $role->permissions()->sync(array($manage_users->id, $manage_truck->id));

        $role = Role::create(array('name'=>'admin','display_name'=>'Administrator'));
        $role->permissions()->sync(array($manage_truck->id, $manage_users->id, $manage_oauth->id, $god_view->id));

        $user->attachRole(Role::where('name','admin')->first());

        for($i=0;$i <= $faker->numberBetween(10,100); $i++)
        {
            $nome = $faker->name;
            $slug = SlugService::createSlug(User::class, 'slug', substr(bcrypt($nome.Carbon::now()->toDateTimeString()),0,20), ['unique' => true]);
            $user = new User();
            $user->name = $nome;
            $user->email = $faker->email;
            $user->password = bcrypt("thithi");
            $user->hometown = 'Curitiba';
            $user->age = $faker->numberBetween(18,70);
            $user->avatar = '';
            $user->slug = $slug;
            $user->save();
        }

    }
}
