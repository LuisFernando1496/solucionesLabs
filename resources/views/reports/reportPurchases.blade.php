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
        
            <h4 >REPORTE DE COMPRAS</h4>
            <table style="width: 100%; margin-top:20px;">
                <tr>
                    <th class="backgroundColor">CODIGO</th>
                    <th class="backgroundColor">PRODUCTO</th>
                    <th class="backgroundColor">COSTO</th>
                    <th class="backgroundColor">CANTIDAD</th>
                    <th class="backgroundColor">TOTAL</th>
                </tr>
                @foreach ($purchases as $p)
                <tr>
                    
                    <td>{{$p->bar_code}}</td>
                    <td>{{$p->name}}</td>
                    <td>${{$p->cost }}</td>
                    <td>{{$p->quantity}}</td> 
                    <td>${{$p->total}}</td>

                    
                    

                </tr>
                @endforeach
            </table>

            <h5 style="margin: 20px;">REPORTE GENERADO POR {{strtoupper($user->name." ".$user->last_name)}}</h5>
            
        </div>
    </body>
</html>