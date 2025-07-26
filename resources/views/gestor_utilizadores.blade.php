<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Utilizadores</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gestão de Utilizadores</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Lista de Clientes --}}
    <h3>Clientes</h3>
    @if($clientes->isEmpty())
        <div class="alert alert-info">Não há clientes registados.</div>
    @else
        <table class="table table-bordered mb-4">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->role->name }}</td>
                        <td>
                            <form action="{{ route('gestor.utilizadores.tornarMecanico', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja tornar este cliente num mecânico?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary btn-sm">Tornar Mecânico</button>
                            </form>
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
