<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #111;
            color: #fff;
            min-height: 100vh;
        }

        .welcome-container {
            min-height: 100vh;
        }

        .welcome-image {
            max-width: 250px;
            width: 100%;
            height: auto;
        }

        .slogan {
            font-size: 1rem;
            text-align: center;
            margin-top: 1rem;
        }

        .btn-custom {
            min-width: 150px;
            margin: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex fw-bold text-uppercase flex-column justify-content-center align-items-center text-center welcome-container">
        <img src="https://i.ibb.co/SDRT7LGB/OOD.png" alt="Logo" class="welcome-image">

        <p class="slogan mt-3">Doe alimentos. Reduza o desperdício. Alimente quem precisa.</p>

        <div class="d-flex flex-column flex-sm-row justify-content-center mt-4">
            <a href="{{ route('login.form') }}" class="btn btn-primary btn-custom">Entrar</a>
            <a href="{{ route('register.form') }}" class="btn btn-outline-light btn-custom">Criar Conta</a>
        </div>
    </div>
</body>
</html>
