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
            <h3 >ESTADO DE CUENTA</h3>
            <h4>{{$client->name}} {{$client->last_name}}</h4>
            <h3>DIAS DE PAGO: {{$client->payment_days}}</h3>

            <br/>
            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">FOLIO DE VENTA</th>
                    <th class="backgroundColor">PRODUCTO</th>
                    <th class="backgroundColor">PRECIO</th>
                    <th class="backgroundColor">FECHA</th>

                </tr>
                @foreach ($credits as $c)
                <tr>
                    <td>{{$c->folio}}</td>
                    <td>{{$c->producto}}</td>
                    <td>{{$c->precio}}</td>
                    <td>{{$c->fecha}}</td>
                </tr>
                @endforeach
            </table>


            <h3>PAGOS</h3>
            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">FOLIO</th>
                    <th class="backgroundColor">PAGO</th>
                    <th class="backgroundColor">RESTANTE</th>
                    <th class="backgroundColor">FECHA</th>

                </tr>
                @foreach ($payments as $p)
                <tr>
                    <td>{{$p->folio}}</td>
                    <td>{{$p->pago}}</td>
                    <td>{{$p->restante}}</td>
                    <td>{{$p->fecha}}}}</td>
                </tr>
                @endforeach
            </table>

            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">ADEUDO TOTAL</th>
                    <th> {{$total}}</th>

                </tr>
            </table>
            
        </div>
    </body>
</html>