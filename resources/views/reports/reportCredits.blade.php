<html>
    <head>
        <style type="text/css">
            table {
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
                text-align: center;
                border-color: #424242;
            }
            .backgroundColor{
                background: red;
            }
        </style>
    </head> 
    <body>
        <div style="text-align:center; margin-left: auto; margin-right: auto;">
            <h4 >REPORTE DE CREDITOS</h4>
            <h5>DESDE {{$from}} HASTA {{$to}}</h5>

            <br/>
            <h3> REPORTE DE CREDITOS POR VENTA</h3>
            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">FOLIO DE VENTA</th>
                    <th class="backgroundColor">NOMBRE</th>
                    <th class="backgroundColor">APELLIDOS</th>
                    <th class="backgroundColor">CANTIDAD</th>
                    <th class="backgroundColor">FECHA</th>

                </tr>
                @foreach ($bySale as $s)
                <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->last_name}}</td>
                    <td>{{$s->cart_total}}</td>
                    <td>{{$s->created_at}}</td>
                </tr>
                @endforeach
            </table>


            <h3>TOTAL POR CLIENTE</h3>
            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">NOMBRE</th>
                    <th class="backgroundColor">APELLIDOS</th>
                    <th class="backgroundColor">CANTIDAD</th>

                </tr>
                @foreach ($byClient as $s)
                <tr>
                    <td>{{$s->name}}</td>
                    <td>{{$s->last_name}}</td>
                    <td>{{$s->cart_total}}</td>
                </tr>
                @endforeach
            </table>

            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">TOTAL GENERAL</th>
                    <th> {{$total}}</th>

                </tr>
            </table>


            <h5 style="margin: 20px;">REPORTE GENERADO POR {{strtoupper($user->name." ".$user->last_name)}}</h5>
            
        </div>
    </body>
</html>