<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota de credito</title>    
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
        Fecha: {{$sale->created_at->format('d-m-y h:m:s')}} <br>
        Folio: {{$sale->id}}
    </th>
    </thead>
</table>
<br>
    
<br/>
    @if(!empty($client))
    Crédito: {{$client->name}}  @if($client->last_name != 'NO APLICA'){{ $client->last_name}} @endif @endif <br/>
   <hr>
  
  
    <section style="display: flex; justify-content: space-between; align-items: center;">
        <table style="width: 100%">
            <tr>
                <thead style="font-size: 90%">
                    <th >CANTIDAD</th>
                        <th >MARCA</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>DESCUENTO</th>
                    <th>TOTAL</th>
            </thead>
            <hr>
            </tr>
           <tbody style="text-align: center;font-size: 86%">
    @foreach($sale->productsInSale as $product)
<<<<<<< HEAD
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div id="pro-td">
                {{$product->quantity}}
            </div>
            <div id="pre-td" style="text-align: center;">{{$product->product->name}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($product->sale_price,2,',','.')}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">{{$sale->amount_discount}}</div>
            <div id="subtotal" style="text-align: center;">${{number_format($sale->cart_total,2,',','.')}} </div>
=======
        <tr>
            <td> {{$product->quantity}}</td>  
             <td>{{$product->product->brand->name}} </td> 
          <td>{{$product->product->name}} </td> 
        <td> ${{number_format($product->sale_price,2,',','.')}} </td>  
          <td> @if($product->discount != 0)${{number_format($product->discount,2,',','.')}}@else-@endif</td>
          <td>${{number_format($product->subtotal,2,',','.')}}  </td>
>>>>>>> 9661477e707743263668148577f2330f4a0384d2
        </div>
       </tr>
    @endforeach
     </tbody>
        </table>
        
    </section>
    <hr/>
    <br/>
    <div id="total">
<<<<<<< HEAD
        Pago a crédito: {{$client->name." ".$client->last_name}} <br>
        Dias de pago: {{$client->payment_days}} <br>
=======
       <br/>
     
>>>>>>> 9661477e707743263668148577f2330f4a0384d2
        @if($sale->discount != null)Descuento:  %{{number_format($sale->discount,2,'.',',')}}@endif
       
        <br>
        Total: ${{number_format($sale->cart_total,2,'.',',')}}
    </div>
    
    <br/>
    <br/>
    <br/>
    <p class="centrado">_____________________________</p>
    <p class="centrado">Firma</p>

</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>
