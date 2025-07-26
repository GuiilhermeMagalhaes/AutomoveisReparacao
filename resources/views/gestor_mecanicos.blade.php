<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Mecânicos</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Mecânicos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Oficina Atual</th>
                <th>Atribuir Oficina</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mecanicos as $mecanico)
                <tr>
                    <td>{{ $mecanico->user->name }}</td>
                    <td>{{ $mecanico->user->email }}</td>
                    <td>{{ $mecanico->oficina->nome ?? 'Não atribuída' }}</td>
                    <td>
                        <form action="{{ route('gestor.atribuirOficina', $mecanico->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex">
                                <select name="oficina_id" class="form-select me-2" required>
                                    <option value="">Selecionar Oficina</option>
                                    @foreach($oficinas as $oficina)
                                        <option value="{{ $oficina->id }}">{{ $oficina->nome }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Atribuir</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('gestor.removerMecanico', $mecanico->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este mecânico?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>
