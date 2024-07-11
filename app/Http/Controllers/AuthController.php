<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public $rules = [
        'email'=>'required|email',
        'password'=>'required'
    ];
    public $messages = [
        'email.required' => "l'email est obligatoire veuillez le saisir.",
        'email.email' => "Cet email est invalide.",
        'password.required' => "le mot de passe est obligatoire veuillez le saisir."
    ];

    public function login(){
        return view('authentification.login');
    }

    public function make(Request $request ){
        $credentials = $request->validate($this->rules, $this->messages);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.index'));
        }
        return to_route('login')->withErrors([
            'email'=>'email ou mot de passe invalide'
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return to_route('login');
    }
}
