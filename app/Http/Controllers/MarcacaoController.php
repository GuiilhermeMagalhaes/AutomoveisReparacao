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

    public function listarMarcacoesCliente()
    {
        $cliente = Auth::user()->cliente;
        $marcacoes = Marcacao::where('cliente_id', $cliente->id)->get();

        return view('marcacoescliente', compact('marcacoes'));
    }

    public function cancelarMarcacao($id)
{
    $marcacao = Marcacao::findOrFail($id);

    // Garante que a marcação pertence ao cliente logado
    if ($marcacao->cliente_id !== Auth::user()->cliente->id) {
        abort(403, 'Acesso não autorizado.');
    }

    $marcacao->estado = 'Cancelada';
    $marcacao->save();

    return redirect()->route('clientemarcacoes')->with('success', 'Marcação cancelada com sucesso.');
}

}

