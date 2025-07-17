<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {

         if (Auth::check()) {
        return redirect()->route('home'); // Ou dashboard personalizada
    }
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            // 'matricula' => 'required|string',
            // 'marca' => 'required|string',
        ]);

        $clienteRole = Role::where('name', 'Cliente')->first();

        if (!$clienteRole) {
            throw new \Exception("O papel 'Cliente' não existe na base de dados.");
        }

        DB::transaction(function () use ($request, $clienteRole) {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role_id' => $clienteRole->id,
            ]); 

            Cliente::create([
                'user_id' => $user->id,
                // 'matricula' => $request->input('matricula'),
                // 'marca' => $request->input('marca'),
            ]);
        });

        return redirect()->route('home')->with('success', 'Conta criada com sucesso!');
    }
}
