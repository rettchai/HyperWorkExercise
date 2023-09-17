<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
// use App\Models\Permissions;
// use App\Models\RefPermissions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;

class LaravelPassportController extends Controller
{
    //
    public function getRedirect(Request $request)
    {
        return Socialite::driver('laravelpassport')->redirect();
    }

    public function getCallback(Request $request)
    {
        $user = Socialite::driver('laravelpassport')->user();
        // dd( $user);

        $login = User::updateOrCreate([
                            'auth_id' => $user->user['auth_id'],
                            'auth_type' => "oauth2-rmutr",
                        ], [
                            'auth_type' => "oauth2-rmutr",
                            'auth_id' => $user->user['auth_id'],
                            'name' => $user->user['description'],
                            'email' => $user->user['mail'],
                            'username' => $user->user['samaccountname'],
     ]);
        Auth::login($login);

        // if(count($users->getPermission)) {
        //     foreach($users->getPermission as $row) {
        //         if($row->active == true) {
        //             Auth::guard($row->permission)->login($users);
        //         }
        //     }
        // }

        // $token = $login->createToken('viewer')->plainTextToken;
        $token = $login->createToken($login->user_role->role_name)->plainTextToken;

        // dd($token);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);


        // return redirect()->route('welcome');

    }
}
