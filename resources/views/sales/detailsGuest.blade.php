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

        <div class="my-3 my-md-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="card-header text-uppercase">Detalles de venta</div>
                        <center>
                        <table class="display table table-striped table-bordered"  style="width:100%">
                        <tfoot>
                            <tr>
                            <td colspan="1"></td>
                            <td colspan="1"><b>Status:  </td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1">{{$sale->track_status}}</td>
                            </tr>
                            <tr>
                            <td colspan="1"></td>
                            <td colspan="1"><b>Descuento en venta: </b>{{$sale->discount}}%</td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            </tr>
                            <tr>
                            <td colspan="1"></td>
                            <td colspan="1"><b>Descuento total: </b>${{$sale->amount_discount}}</td>
                            <td colspan="1"></td>
                            <td colspan="1"></td>
                            <td colspan="1"><b>Total: </b>${{$sale->cart_total}}</td>
                            </tr>
                    
                        </tfoot>
                            <thead>
                            <tr>
                                <th class="text-center">Nombre producto/servicio</th>
                                <th class="text-center" >Descuento</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Subtotal</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $item)
                                <tr>
                                    <td class="text-center">{{$item->name}}</td>
                                    <td class="text-center">{{$item->discount}}%</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">${{$item->sale_price}} c/u</td>
                                    <td class="text-center">${{$item->subtotal}}</td>                                    
                                </tr>
                                
                            @endforeach
                                
                            </tbody>
                        </table>
                        @if ($client != null)
                        <table class="display table table-striped table-bordered"  style="width:100%">
                            <div class="card-header text-uppercase">Cliente</div>
                            
                            <tr>
                                <td>Nombre: {{$client->name}}</td>
                                <td>Apellidos: {{$client->last_name}}</td>
                                <td>Télefono: {{$client->phonenumber}}</td>
                                <td>Correo: {{$client->email}}
                            </tr>
                                
                            

                        </table>
                        @endif
                        </center>
                     
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
            
        </div>
    </main>
</body>

</html>