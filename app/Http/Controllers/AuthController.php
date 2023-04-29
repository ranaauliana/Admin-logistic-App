<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Output\ConsoleOutput;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSimpan(Request $request)
    {
        User::create([
            'nama' =>$request->nama,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'level' =>$request->level,
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login', [
            'title' => "Login",
        ]);
    }

    public function loginAksi(Request $request)
    {
        // session (support) flash untuk pesan flash
        Session::flash('email', $request->email);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        
        // return response()->json($userPassword);
        
        
        if($user) {

            $userPassword = $user['password'];
            if (Hash::check($password, $userPassword)) {
                return redirect()->route('dashboard');
            }else{
                return response()->view('auth/login', [
                    "title" => "Login",
                    "error" => "Password salah!"
                ]);
            }
        }else{
            return response()->view('auth/login', [
            "title" => "Login",
            "error" => "Email tidak terdaftar!"
        ]);
    }
    }
}
