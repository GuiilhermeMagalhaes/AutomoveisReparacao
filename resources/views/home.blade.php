<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <section class="conteudo">
        <h1>Marcações</h1>
        <p>Bem-vindo à página de marcações. Aqui podes criar novas marcações para os teus serviços.</p>
        <button class="btn btn-primary" onclick="window.location.href='{{ route('criarmarcacao') }}'">Criar Marcação</button>
        <button class="btn btn-secondary" onclick="window.location.href='{{ route('clientemarcacoes') }}'">Ver Marcações</button>
    </section>


</body>
</html>