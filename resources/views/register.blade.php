<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Criar Conta</title>
</head>
<body>
    

    <section class="conteudo">
        <h1>Criar Conta</h1>
        <p>Preencha os campos abaixo para criar uma nova conta.</p>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif    
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nomeInput" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeInput" name="name">
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password">
            </div>

            <div class="mb-3">
                <label for="passwordConfirmationInput" class="form-label">Confirmar Password</label>
                <input type="password" class="form-control" id="passwordConfirmationInput" name="password_confirmation">
            </div>
            <div class="mb-3">
                <a href="{{ route('login') }}">Já tens conta? Inicia sessão aqui</a>
            </div>    
            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>
    </section>  
</body>
</html>