<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Marcações do Mecânico</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Minhas Marcações</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($marcacoes->isEmpty())
        <div class="alert alert-info">Não tens marcações atribuídas.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Oficina</th>
                    <th>Estado</th>
                    <th>Comentário</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marcacoes as $marcacao)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($marcacao->data)->format('d/m/Y H:i') }}</td>
                        <td>{{ $marcacao->cliente->user->name ?? 'N/A' }}</td>
                        <td>{{ $marcacao->oficina->nome ?? 'N/A' }}</td>
                        <td>{{ ucfirst($marcacao->estado) }}</td>
                        <td>{{ $marcacao->comentario ?? '-' }}</td>
                        <td>
                            @if($marcacao->estado === 'em_execucao')
                                <form action="{{ route('mecanico_concluir', $marcacao->id) }}" method="POST" onsubmit="return confirm('Confirmar conclusão da marcação?');">
                                    @csrf
                                    @method('PATCH')
                                        <div class="mb-2">
                                            <textarea name="comentario" class="form-control" placeholder="Comentário do serviço..." rows="2" required></textarea>
                                        </div>
                                            <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                                </form>

                            @else
                                <span class="text-muted">---</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>
