<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Criar Marcação</title>
</head>
<body>
    <section class="conteudo">
        <h1>Criar Marcação</h1>

        <form method="POST" action="{{ route('criarmarcacao.store') }}">
    @csrf
    
    <div class="mb-3">
        <label for="oficina_id" class="form-label">Oficina</label>
        <select class="form-select" name="oficina_id" id="oficina_id">
            <option selected disabled>Escolha uma oficina</option>
            @foreach($oficinas as $oficina)
                <option value="{{ $oficina->id }}">{{ $oficina->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" name="data" id="data">
    </div>

    <button type="submit" class="btn btn-primary">Criar Marcação</button>
</form>

    </section>
</body>
</html>