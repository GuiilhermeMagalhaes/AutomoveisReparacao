<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Mostra o formulário de login
    public function show()
    {

        if (Auth::check()) {
            return redirect()->route('home'); // Ou dashboard personalizada
        }

        return view('login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redireciona para a página inicial
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'As credenciais estão incorretas.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
