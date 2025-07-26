<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Gestor Marcações</title>
</head>
<body>

<div class="conteudo">
    <h1>Todas as Marcações</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>Oficina</th>
                <th>Estado</th>
                <th>Mecânico</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marcacoes as $marcacao)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($marcacao->data)->format('d/m/Y') }}</td>
                    <td>{{ $marcacao->cliente->user->name ?? 'N/A' }}</td>
                    <td>{{ $marcacao->oficina->nome ?? 'N/A' }}</td>
                    <td>{{ ucfirst($marcacao->estado) }}</td>
                    <td>
                        @if ($marcacao->estado === 'pendente')
                            <form action="{{ route('gestor.atribuirMecanico', $marcacao->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex">
                                    <select name="mecanico_id" class="form-select me-2" required>
                                        <option value="">Selecionar</option>
                                        @foreach($mecanicos as $mecanico)
                                            <option value="{{ $mecanico->id }}">{{ $mecanico->user->name ?? 'N/A' }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-success btn-sm">Atribuir</button>
                                </div>
                            </form>
                        @else
                            {{ $marcacao->mecanico->user->name ?? '---' }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn btn-secondary" onclick="window.location.href='{{ route('home') }}'">Voltar</button>
</div>

</body>
</html>
