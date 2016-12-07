<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
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
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $db_user = User::findForPassport($user->getId());
        if($db_user)
        {
            $this->refreshUser($db_user,['name'=>$user->getName(),'email'=>$user->getEmail(),'avatar'=>$user->getAvatar()]);
        }else{
            $this->registerUser(['id'=>$user->getId(),'name'=>$user->getName(),'email'=>$user->getEmail(),'avatar'=>$user->getAvatar()]);
        }
        redirect('/home');
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
    }

    public function refreshUser(User $user, array $data){
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->avatar = $data['avatar'];
    }

}
