<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Marcações</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Minhas Marcações</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($marcacoes->isEmpty())
            <div class="alert alert-info">Ainda não tens marcações criadas.</div>
        @else
            <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Data</th>
            <th>Oficina</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marcacoes as $marcacao)
            <tr>
                <td>{{ \Carbon\Carbon::parse($marcacao->data)->format('d/m/Y') }}</td>
                <td>{{ $marcacao->oficina->nome ?? 'Oficina removida' }}</td>
                <td>{{ $marcacao->estado }}</td>
                <td>
                    @if ($marcacao->estado !== 'Cancelada')
                        <form action="{{ route('clientemarcacao.cancelar', $marcacao->id) }}" method="POST" onsubmit="return confirm('Tens a certeza que queres cancelar esta marcação?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                        </form>
                    @else
                        <span class="text-muted">Já cancelada</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        @endif

        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>