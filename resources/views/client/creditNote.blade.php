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
td,th,tr,table {
    border-top: 1px solid black;
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
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}

</style>
<div>
    <img class="center" src="{{asset('/logo_inusual.png')}}" alt="Logotipo">
    <p class="centrado">
        Calle {{$sale->branchOffice->address->street}},Numero {{$sale->branchOffice->address->ext_number}} <br>
        Colonia {{$sale->branchOffice->address->suburb}} <br>
        Atendido por {{Auth::user()->name}} {{Auth::user()->last_name}} <br>
        Fecha: {{$sale->created_at->format('d-m-y h:m:s')}} <br>
        Folio: {{$sale->id}}
    </p>
    <section style="display: flex; justify-content: space-between; align-items: center;">
        <div id="pro-th">CANTIDAD</div>
        <div id="pre-th">PRODUCTO  <br></div>
        <div id="cod-th">PRECIO</div>
        <div id="subtotal">DESCUENTO</div>
        <div id="cod-th">DEPOSITO</div>
        <div id="subtotal">TOTAL</div>
    </section>
    <hr>
    @foreach($sale->productsInSale as $product)
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div id="pro-td">
                {{$product->quantity}}
            </div>
            <div id="pre-td" style="text-align: center;">{{$product->product->name}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($product->sale_price,2,',','.')}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">@if($product->discount != 0)${{number_format($product->discount,2,',','.')}}@else-@endif</div> 
            <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($pay->deposit,2,',','.')}} </div>
            <div id="subtotal" style="text-align: center;">${{number_format($pay->leftover,2,',','.')}} </div>
        </div>
        <hr>
    @endforeach
    <div id="total">
        Pago a crédito: {{$client->name." ".$client->last_name}}
        Dias de pago: {{$client->payment_days}}
        @if($sale->discount != null)Descuento:  %{{number_format($sale->discount,2,'.',',')}}@endif
        <br>
        Subtotal:  ${{number_format($sale->cart_subtotal,2,'.',',')}}
        <br>
        Total: ${{number_format($sale->cart_total,2,'.',',')}}
    </div>
    <p class="centrado">RFC:{{Auth::user()->rfc}} </p>
    <p class="centrado">Email: {{Auth::user()->email}}</p>
    <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    <br/>
    <br/>
    <br/>
    <p class="centrado">_____________________________</p>
    <p class="centrado">{{$client->name." ".$client->last_name}}</p>

</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>
