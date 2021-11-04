@extends('layouts.app')

@section('content')
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

                            <br>
                        <div style="">
                            <h2>¿Desea modificar el status?</h2>
                            <div>
                                <form action="/changeTrackStatus" method="POST" style="width:50%;text-align: center;" >
                                    <input type="hidden" name="sale_id" value="{{$sale->id}}">
                                    <select class="form-control form-control-lg" aria-label="Default select example" name="trackStatus" id="">
                                    @if("Pedido enviado" == $sale->track_status)
                                        <option selected value="Pedido enviado">Pedido enviado</option>
                                    @else
                                        <option value="Pedido enviado">Pedido enviado</option>
                                    @endif

                                    @if("Pedido recibido" == $sale->track_status)
                                        <option selected value="Pedido recibido">Pedido recibido</option>
                                    @else
                                        <option value="Pedido recibido">Pedido recibido</option>
                                    @endif

                                    @if("Pedido generado" == $sale->track_status)
                                        <option selected value="Pedido generado">Pedido generado</option>
                                    @else
                                        <option value="Pedido generado">Pedido generado</option>
                                    @endif
                                    </select>
                                    <button type="submit" class="btn btn-success">Actualizar status</button>

                                </form>
                            </div>
                            
                        </div>

                        </center>
                     
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
