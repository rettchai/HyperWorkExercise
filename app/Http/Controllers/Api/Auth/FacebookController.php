<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    //
    public function getredirect(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getcallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        $login = User::updateOrCreate([
                'auth_id' => $user->id,
                'auth_type' => "facebook",
            ], [
                'auth_type' => "facebook",
                'auth_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_photo_path' => $user->avatar,
                'username' => $user->email,
            ]);

        Auth::login($login);


        // if ($users) {
        //     $refpermissions = RefPermissions::all();
        //     foreach ($refpermissions as $row) {
        //         $chk_admin = Permissions::join('users', 'users.id', '=', 'permissions.user_id')
        //         ->where([
        //             ['users.id',$users->id],
        //             ['permissions.permission',$row->id],
        //             ['permissions.active','1'],
        //         ])->first();

        //         if ($chk_admin) {
        //             Auth::guard($row->permission_en)->login($users);
        //         };
        //     }
        // }


        $token = $login->createToken('viewer')->plainTextToken;
        // dd($token);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

        // return redirect('/users');
        // return redirect('/dashboard');
        // return redirect('/conference');
        // return redirect(route("home"));


        // echo $user->token;
        // dd($user);
    }
}
