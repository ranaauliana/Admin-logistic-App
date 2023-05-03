<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
    try {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('google_id', $user->id)->first();
        // dd($user);

        if(!$findUser){
            // create new user
            $newUser = User::updateOrCreate(['email' => $user->email], [
                'nama' =>$user->name,
                'google_id'=> $user->id,
                'password'=> Hash::make('password'),
                'level' => 'User',
            ]);

            session(['loginId' => $newUser->id, 'nama' => $newUser->nama, 'level' => $newUser->level]);
        }
        
        session(['loginId' => $findUser->id, 'nama' => $findUser->nama, 'level' => $findUser->level]);

        return redirect('dashboard');


    } catch (\Throwable $th) {
        return redirect('login');
    }










        // try{
        //     $user = Socialite::driver('google')->user();

        //     return response()->json($user);

        //     $finduser = User::where('google_id', $user->id)->first();

        //     if($finduser){

        //         session(['loginId' => $finduser->id, 'nama' => $finduser->nama]);

        //         return redirect('dashboard');

        //     }else{

        //         $newUser = User::updateOrCreate(['email' => $user->email], [
        //             'name' =>$user->name,
        //             'google_id'=> $user->id,
        //             // 'password'=> Hash::make('password'),
        //         ]);

        //         session(['loginId' => $newUser->id, 'nama' => $newUser->nama]);

        //         return redirect('dashboard');
        //     }



        // }catch(Exception $e){
        //     dd($e->getMessage());
        // }
 
        // $user->token;
    }
}
