<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@1.0.0/lib/jquery.tabletojson.min.js" integrity="sha256-H8xrCe0tZFi/C2CgxkmiGksqVaxhW0PFcUKZJZo1yNU=" crossorigin="anonymous"></script>
    @stack('scripts')
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar2')
    <main class="py-4">
        <div class="container">

        <center>
            <form action="/searchSaleById" method="POST">
                <div class="card">
                    <h5 class="card-header">¿Deseas saber el status de tu pedido?</h5>
                    <div class="card-body">
                        <h5 class="card-title">Ingresa aquí tu ID del pedido</h5>
                        <p class="card-text">
                            <input type="text" name="sale_id" class="form-control" id="" aria-describedby="emailHelp" placeholder="Ingresa tu ID">
                        </p>
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </center>
            
        </div>
    </main>
</body>

</html>