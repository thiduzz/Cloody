<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Truck;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showFoodtruckRegistrationForm()
    {
        return view('auth.register-foodtruck');
    }

    protected function foodtruckAccountValidate(Request $request)
    {
        return $this->validator($request->all())->validate();
    }

    protected function foodtruckTruckValidate(Request $request)
    {
        return $this->truck_validator($request->all())->validate();
    }

    protected function foodtruckFullValidate(Request $request)
    {
        return $this->full_truck_validator($request->all())->validate();
    }

    protected function truck_validator(array $data)
    {
        return Validator::make($data, [
            'foodtruck_name' => 'required|max:255',
            'foodtruck_service_type' => 'required|max:100',
            'foodtruck_identification' => 'required|min:18',
            'foodtruck_phone' => 'required',
            'foodtruck_address' => 'required|max:255',
            'foodtruck_formal_name' => 'required|max:100',
            'avatar' => 'required|image'
        ]);
    }



    protected function full_truck_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'register_type' => 'required|in:trucker',
            'foodtruck_name' => 'required|max:255',
            'foodtruck_service_type' => 'required|max:100',
            'foodtruck_identification' => 'required|min:18',
            'foodtruck_phone' => 'required',
            'foodtruck_address' => 'required|max:255',
            'foodtruck_formal_name' => 'required|max:100',
            'foodtruck_lets_negotiate' => 'required',
            'foodtruck_delivery_bike' => 'required',
            'foodtruck_delivery_motorcycle' => 'required',
            'avatar' => 'required|image'
        ]);
    }

    public function truck_register(Request $request)
    {

            $this->full_truck_validator($request->all())->validate();
        try{
            DB::beginTransaction();
            event(new Registered($user = $this->create($request->all())));
            $truck = $this->create_truck($request, $user);
            $this->guard()->login($user);
            DB::commit();
            return new JsonResponse(['success'=>true, 'message'=>'Account successfully registered!'],200);
        }catch(Exception $e)
        {
            DB::rollBack();
            return new JsonResponse(['success'=>false, 'message'=>'An unexpected happened!'],500);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create_truck(Request $request, User $user)
    {
        $path = $request->file('avatar')->store(
            'avatars/'.$user->id, 's3'
        );
        Storage::disk('s3')->setVisibility($path, 'public');
        $data = $request->all();
        $truck = Truck::create([
            'name' => $data['foodtruck_name'],
            'service_type' => $data['foodtruck_service_type'],
            'identification' => $data['foodtruck_identification'],
            'phone' => $data['foodtruck_phone'],
            'address' => $data['foodtruck_address'],
            'formal_name' => $data['foodtruck_formal_name'],
            'lets_negotiate' => ($data['foodtruck_lets_negotiate']  == "true" ? true : false),
            'delivery_bike' => ($data['foodtruck_delivery_bike'] == "true" ? true : false),
            'delivery_motorcycle' => ($data['foodtruck_delivery_motorcycle']  == "true" ? true : false),
            'logo'=> $path,
            'status'=>'unavailable',
            'enabled'=>false
        ]);
        $truck->users()->attach($user);
        return $truck;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'register_type' => 'required|in:customer,trucker',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $slug = SlugService::createSlug(User::class, 'slug', substr(bcrypt($data['name'].Carbon::now()->toDateTimeString()),0,20), ['unique' => true]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'slug' => $slug
        ]);
        if($data['register_type'] == 'trucker')
        {
            $user->attachRole(Role::where('name','trucker')->first());
            $user->enabled = false;
            $user->save();
        }else{
            $user->attachRole(Role::where('name','customer')->first());
        }
        return $user;
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }
}
