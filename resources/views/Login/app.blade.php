<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #111;
            color: #fff;
        }

        .full-height-wrapper {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .background-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.07;
            filter: blur(15px);
            width: 150vw;
            max-width: none;
            z-index: 0;
            pointer-events: none;
        }

        .content-layer {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .card-wrapper {
            max-width: 420px;
            margin: auto;
        }

        @media (max-height: 600px) {
            .full-height-wrapper {
                align-items: flex-start;
                padding-top: 2rem;
            }
        }
    </style>
</head>
<body>
    <img src="https://i.ibb.co/SDRT7LGB/OOD.png" alt="Logo Fundo" class="background-image">

    <div class="full-height-wrapper">
        <div class="content-layer">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
