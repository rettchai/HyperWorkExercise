<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function getRedirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function getCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $login = User::updateOrCreate([
            'auth_id' => $user->id,
            'auth_type' => "google",
        ], [
            'auth_type' => "google",
            'name' => $user->name,
            'email' => $user->email,
            'profile_photo_path' => $user->avatar,
            'username' => $user->email,
            ]);
        Auth::login($login);



        // if(count($login->getPermission)) {
        //     foreach($login->getPermission as $row) {
        //         if($row->active == true) {
        //             Auth::guard($row->permission)->login($login);
        //         }
        //     }
        // }

        $token = $login->createToken('viewer')->plainTextToken;
        // dd($token);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

        // return redirect()->route('dashboard');

    }
}
