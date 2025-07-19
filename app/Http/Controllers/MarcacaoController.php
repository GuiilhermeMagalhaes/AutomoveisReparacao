<?php

namespace App\Http\Controllers;
use App\Models\Oficina;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Marcacao;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class MarcacaoController extends Controller
{
    public function createMarcacao()
    {
        $oficinas = \App\Models\Oficina::all();
        return view('criarmarcacao', compact('oficinas'));
    }

    public function storeMarcacao(Request $request)
{
    // Validação do formulário
    $request->validate([
        'oficina_id' => 'required|exists:oficinas,id',
        'data' => 'required|date|after:today',
    ]);

    // Criar marcação
    \App\Models\Marcacao::create([
        'cliente_id' => Auth::user()->cliente->id,
        'oficina_id' => $request->input('oficina_id'),
        'data' => $request->input('data'),
        'estado' => 'Pendente',
    ]);

    return redirect()->route('home')->with('success', 'Marcação criada com sucesso!');
    }
}
