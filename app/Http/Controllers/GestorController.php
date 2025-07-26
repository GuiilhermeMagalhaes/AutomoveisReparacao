<?php

namespace App\Http\Controllers;
use App\Models\Marcacao;
use App\Models\Mecanico;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Oficina;
use App\Models\Cliente;
use App\Models\Utilizador;
use App\Models\MarcacaoMecanico;
use App\Models\MarcacaoCliente;


use Illuminate\Http\Request;

class GestorController extends Controller
{
    public function listarMarcacoesGestor()
    {
    $marcacoes = Marcacao::with(['cliente.user', 'oficina', 'mecanico.user'])->get();
    $mecanicos = \App\Models\Mecanico::with('user')->get();

    return view('gestormarcacoes', compact('marcacoes', 'mecanicos'));
    }

    public function listarUtilizadores()
{
    $clientes = \App\Models\User::whereHas('role', function ($query) {
        $query->where('name', 'Cliente');
    })->get();

    return view('gestor_utilizadores', compact('clientes'));
}

public function tornarMecanico($id)
{
    $user = \App\Models\User::findOrFail($id);

    // Verifica se ainda é cliente
    if ($user->role->name === 'Cliente') {
        // Altera o papel para 'Mecanico'
        $mecanicoRole = \App\Models\Role::where('name', 'Mecanico')->firstOrFail();
        $user->role_id = $mecanicoRole->id;
        $user->save();

        // Cria perfil de mecânico
        \App\Models\Mecanico::create([
            'user_id' => $user->id,
            'oficina_id' => null, // Presumindo que o cliente tem uma oficina associada
        ]);

        return redirect()->back()->with('success', 'Utilizador convertido em Mecânico com sucesso.');
    }

    return redirect()->back()->with('error', 'Este utilizador não é um cliente ou já é mecânico.');
}

public function listarMecanicos()
{
    $mecanicos = Mecanico::with(['user', 'oficina'])->get();
    $oficinas = Oficina::all();

    return view('gestor_mecanicos', compact('mecanicos', 'oficinas'));
}

public function atribuirOficina(Request $request, $id)
{
    $request->validate([
        'oficina_id' => 'required|exists:oficinas,id',
    ]);

    $mecanico = Mecanico::findOrFail($id);
    $mecanico->oficina_id = $request->input('oficina_id');
    $mecanico->save();

    return redirect()->back()->with('success', 'Oficina atribuída com sucesso.');
}

public function removerMecanico($id)
{
    $mecanico = Mecanico::findOrFail($id);


    if ($mecanico->marcacoes()->count() > 0) {
        return redirect()->back()->with('error', 'Não é possível remover o mecânico, pois ele tem marcações associadas.');
    }

    $mecanico->delete();

    return redirect()->back()->with('success', 'Mecânico removido com sucesso.');
}

}