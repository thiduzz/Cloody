<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        $db_user = User::where('social_network_id','=', $user->getId())->where('provider','=','facebook')->first();
        if($db_user != null)
        {
            $this->refreshUser($db_user,['name'=>$user->getName(),'email'=>$user->getEmail(),'avatar'=> $user->avatar_original]);
        }else{
            $db_user = $this->registerUser(['id'=>$user->getId(),'name'=>$user->getName(),'email'=>$user->getEmail(),'avatar'=>$user->avatar_original]);
        }
        Auth::login($db_user, true);
        return redirect('/home');
        // $user->token;
    }

    public function registerUser(array $data){
        $slug = SlugService::createSlug(User::class, 'slug', substr(bcrypt($data['name'].Carbon::now()->toDateTimeString()),0,20), ['unique' => true]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $data['avatar'],
            'slug'=>$slug,
            'social_network_id' => $data['id'],
            'provider' => 'facebook',
        ]);
        $user->attachRole(Role::where('name','customer')->first());
        return $user;
    }

    public function refreshUser(User $user, array $data){
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->avatar = $data['avatar'];
    }

}
