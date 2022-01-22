<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function index(): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return redirect('/event');
    }

    public function login()
    {
        return view('welcome');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/event');
        }
        return redirect("login")->with('error', 'Ошибка');
    }
}
