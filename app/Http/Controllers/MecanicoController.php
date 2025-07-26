<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Marcacao;
use App\Models\Mecanico;
use App\Models\Oficina;
use App\Models\User;
use App\Models\Role;


class MecanicoController extends Controller
{
     public function verMarcacoes()
    {
        $mecanico = Auth::user()->mecanico;
        $marcacoes = Marcacao::with(['cliente.user', 'oficina'])
            ->where('mecanico_id', $mecanico->id)
            ->get();

        return view('mecanico_marcacoes', compact('marcacoes'));
    }

   public function concluirMarcacao(Request $request, $id)
{
    $request->validate([
        'comentario' => 'required|string|max:1000',
    ]);

    $marcacao = Marcacao::findOrFail($id);
    $mecanico = Auth::user()->mecanico;

    if ($marcacao->mecanico_id !== $mecanico->id) {
        abort(403, 'Acesso não autorizado.');
    }

    $marcacao->estado = 'concluido';
    $marcacao->comentario = $request->input('comentario');
    $marcacao->save();

    return redirect()->back()->with('success', 'Marcação concluída com sucesso.');
}

}
