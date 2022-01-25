<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket de credito</title> 
</head>
<body>

<style>
    * {
    font-size: 12px;
    font-family: 'Times New Roman';
}
td,th,tr,table {
    border-top: 1px solid black;
    border-collapse: collapse;
}
td.producto,th.producto {
    width: 150px;
    max-width: 150px;
}
td.cantidad,th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}
td.precio,th.precio {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}
.centrado {
    text-align: center;
    align-content: center;
    width: 100%;
}
.ticket {
    width: 155px;
    max-width: 155px;
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
<div class="ticket">
    <img src="{{asset('/logo_inusual.png')}}" alt="Logotipo">
    <p class="centrado">
        Calle {{$sale->branchOffice->address->street}},Numero {{$sale->branchOffice->address->ext_number}} <br>
        Colonia {{$sale->branchOffice->address->suburb}} <br>
        Atendido por {{Auth::user()->name}} {{Auth::user()->last_name}} <br>
        Fecha: {{$sale->created_at->format('d-m-y h:i:s')}} <br>
        Folio: {{$sale->id}} <br>
        ABONO DE PAGO A CREDITO
    </p>
    <section id="ticket" style="display: flex; justify-content: space-between; align-items: center;">
        <div id="pro-th">CANT</div>
        <div id="pre-th">PRO  <br></div>
        <div id="subtotal">DEP</div>
        <div id="subtotal">REST</div>
    </section>
    <hr>
    @foreach($sale->productsInSale as $product)
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div id="pro-td">
                {{$product->quantity}}
            </div>
            <div id="pre-td" style="text-align: center;">{{$product->product->name}} </div>
            <div id="can-td" style="text-align: center; margin-right:3px !important;">${{number_format($pay->deposit,2,'.',',')}}</div>
            <div id="subtotal" style="text-align: center;">${{number_format($pay->leftover,2,'.',',')}} </div>
        </div>
        <hr>
    @endforeach
    <div id="total">
        @if ($sale->payment_type == 0)
        Pago en efectivo
        @elseif($sale->payment_type == 1)
        Pago con tarjeta
        @else
        Pago a crédito
        @endif
        =========================
        <br>
        @if($sale->discount != null)Descuento: {{number_format($sale->discount,2,'.',',')}}% @endif
        =========================
        <br>
        Subtotal:  ${{number_format($sale->cart_subtotal,2,'.',',')}}
        =========================
        <br>
        Total: ${{number_format($sale->cart_total,2,'.',',')}} <br>
        Deposito: ${{number_format($pay->deposit, 2, '.', ',')}} <br>
        Restante: ${{number_format($pay->leftover, 2, '.', ',')}}
    </div>
    <p class="centrado">RFC:{{Auth::user()->rfc}} </p>
    <p class="centrado">Email: {{Auth::user()->email}}</p>
    <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    <p class="centrado">Este ticket no es comprobante fiscal y se incluirá en la venta del día</p>
</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>