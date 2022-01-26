<!DOCTYPE html>
<html lang="en">
@php
    $subtotals = 0;
    $total =0;
    $descuento =0;
    $variable;
    $title;
    $cliente = $sale->client;
    $variable =  $sale->productsInSale;
    $title = 'Abono';
@endphp
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>    
</head>
<body>

<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
   
}

}
.left{
    margin-left: 0px;
  margin-right: auto;
  margin-top: 0%;
  padding-top: 0%;
}
td,tr,table {
   
    border-collapse: collapse;
}

td.cantidad,th.cantidad {
    word-break: break-all;
}
td.precio,th.precio {
    word-break: break-all;
}
.centrado {
    text-align: center;
    align-content: center;
    width: 100%;
}
img {
    max-width: inherit;
    width: inherit;
}
table.borde
{

  border-collapse:collapse;
}
}
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}

</style>

<div>
    <table class="borde">
    <thead>
        <th class="borde" > <img class="left" src="{{asset('/solucioneslab.png')}}" style="width:210px ; height:150px ;" alt="Logotipo"></th>
        <th>   <p class="centrado">
        Calle {{$sale->branchOffice->address->street}},No {{$sale->branchOffice->address->ext_number}} <br>
        Colonia {{$sale->branchOffice->address->suburb}} <br>
        Tel. 961 141 1395 <br>
        Cel. 961 122 3970 <br>
        Personas Fisicas Con actividades Empresariales y Profesionales
        
    </p></th>
        <th> 
        Fecha: {{$sale->created_at->format('d-m-y h:i:s')}} <br>
        Folio: {{$sale->id}}
    </th>
    </thead>
</table>
<br>
    @if(!empty($cliente))
    Cliente: {{$cliente->name}} @if($cliente->last_name != 'NO APLICA'){{ $cliente->last_name}} <br><br> @endif @endif
  
  
    <section style="display: flex; justify-content: space-between; align-items: center;">
        <table style="width: 100%">
            <tr>
                 <thead style="font-size: 80%">
                    <th>CANTIDAD</th>
                    <th>MARCA</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>DESCUENTO</th>
                    <th>DEPOSITO</th>
                    <th>TOTAL<br>RESTANTE</th>
            </thead>
            <hr>
            </tr>
           <tbody style="text-align: center;font-size: 76%">
               @foreach($variable as $product)
                
                    <tr>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->product->brand->name}}</td>
                        <td>{{$product->product->name}}</td>
                        <td>${{number_format($product->sale_price,2,'.',',')}}</td>
                        <td>@if($product->discount != null)${{number_format($product->amount_discount,2,'.',',')}}@else - @endif</td>
                        <td>${{number_format($pay->deposit,2,'.',',')}}</td>
                        <td>${{number_format($pay->leftover, 2, '.',',')}}</td>
                        
                    </tr>
                    @php
                        $subtotals += $product->sale_price;
                        $total += $product->subtotal;
                        $descuento += $product->discount;
                    @endphp
               @endforeach
           </tbody>
        </table>
        
    </section>
    <hr/>

    <div id="total">
        
        @if($sale->discount != null)
            Descuento:  %{{number_format($sale->discount,2,'.',',')}} <br> 
            Monto de descuento: ${{number_format($sale->amount_discount, 2, '.', ',')}} <br>
        @endif
        Total venta: ${{number_format($sale->cart_total,2,'.',',')}} <br>
        @if(sizeof($history) > 1)
        Deposito anterior: ${{$history[sizeof($history)-2]->deposit}} <br>
        Restante anterior: ${{$history[sizeof($history)-2]->leftover}} <br>
        @endif
        Deposito actual: ${{number_format($pay->deposit, 2, '.', ',')}} <br>
        Restante actual: ${{number_format($pay->leftover, 2, '.', ',')}} <br>


    </div>
    <br>
    <br>
    <br>
    {{$title}}
    <p class="centrado">_____________________________</p>
    <p class="centrado">Firma</p>
    <br/>
    <br/>
    <br/>
   

</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>


