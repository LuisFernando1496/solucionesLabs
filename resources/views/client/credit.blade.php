
@extends('layouts.app')

@section('content')
<div class="container">    
    @if($errors->any())
      @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endforeach
    @endif
    <div class="col-md-8">
        <div class="input-group">
            <input type="text" id="search" style="text-transform: uppercase" class="form-control" name="search" autocomplate="search" placeholder="Buscar credito (Nombre del cliente)"/>
            <div class="input-group-append">
                <button id="searchButton" class="btn btn-outline-secondary">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <table class="display table table-striped table-bordered" style="width:100%" id="tabla2">
        <thead class="black white-text">
            <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Total</th>
                <th scope="col">Abonos</th>
                {{-- solo si es admin --}}
                
                <th scope="col">Restante</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estatus</th>                
        
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="result2">
        </tbody>
    </table>

        <!--<table class="display table table-striped table-bordered" id="example" style="width:100%">-->
        <!--<table class="display table table-striped table-bordered" id="example" style="width:100%">-->
        <table class="display table table-striped table-bordered" id="tabla1" style="width:100%">
            <thead class="black white-text">
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Total</th>
                    <th scope="col">Abonos</th>
                    <th scope="col">Restante</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estatus</th>                
           
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="mydata">
                @foreach ($credit as $item)
                    @php
                        $total = 0;
                        $restante = $item->cart_total;
                    @endphp
                <tr>
                    <th scope="row">{{$item->client->name}}</th>
                    <th>${{$item->cart_total}}</th>
                    <td>
                        @foreach ($item->payments as $item2)
                            @php
                                $total += $item2->deposit;
                                $restante=$item->cart_total-$total;
                            @endphp
                        @endforeach
                        ${{$total}}.00
                    </td>
                    @if(sizeof($item->payments) >= 1)
                    <td>${{$item2->leftover}}</td>
                    @else
                    <td>$0.00</td>
                    @endif
                    <td>{{$item->created_at}}</td>
                    @if($item->status_credit=='adeudo')
                    <td><div class="card" style="text-align:center; background-color:red">
                    <label style="color:white" for="status" >{{$item->status_credit}}</label>
                    </div>
                    </td>
                    @else
                    <td><div class="card" style="text-align:center; background-color:green">
                    <label style="color:white" for="status" >{{$item->status_credit}}</label>
                    </div>
                    </td>
                    @endif
                    <td>                   
                        <div class="row">
                        @if (Auth::user()->rol_id == 1)
                                <form onsubmit="return confirm('Cancelar esta venta?')" action="/sale/{{$item->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm  mx-2" data-type="delete">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                        </svg>   
                                        <small>CANCELAR</small>
                                    </button> 
                                </form>
                            @endif
                        </div>                                                                     
                    </td>
                    <td>
                        <a href="{{asset('sale-detail-history/'.$item->id.'')}}" class="btn btn-primary btn-sm mx-2"><small>DETALLES</small></a>
                    </td>
                </tr>
        
                @endforeach
            </tbody>
        </table>   
</div>
{{ $credit->links() }}
@endsection
@push('scripts')
<script>
    let result = [];
    window.addEventListener("load",function(){
        document.getElementById("search").focus();
        $("#tabla2").prop('hidden', true);
        document.getElementById("search").addEventListener("keyup", function(){
            if (document.getElementById("search").value.length >= 1){
                $("#tabla1").prop('hidden', true);
                $("#tabla2").prop('hidden', false);
                fetch(`credit/busqueda?search=${document.getElementById("search").value.toUpperCase()}`,{
                    method: 'get',
                    headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') }
                }).then(response => response.text())
                .then(text => {
                    document.getElementById("result2").innerHTML = "";
                    result = JSON.parse(text);
                    console.log(result);
                    result.data.forEach(function(element,index){
                        if(element.payments[0] != null){
                            if(element.status_credit == "adeudo"){
                                //estara en rojo
                                let contadorPayments = 0;
                                element.payments.forEach(function(element,index){
                                    contadorPayments += parseFloat(element.deposit);
                                });
                                document.getElementById("result2").innerHTML += //'<tr>'+
                                    '<tr class="item-resultC" style="cursor: grab;" data-id="'+element.id+'">'+
                                        '<th scope="row">'+element.name+'</th>'+
                                        '<th>$'+element.cart_total+'</th>'+
                                        '<td>$'+element.payments[(element.payments.length - 1)]["leftover"]+'</td>'+
                                        '<td>$'+contadorPayments+'.00</td>'+
                                        '<td>'+element.created_at+'</td>'+
                                        '<td><div class="card" style="text-align:center; background-color:red">'+
                                        '<label style="color:white" for="status" >'+element.status_credit+'</label>'+
                                        '</div>'+
                                        '</td>'+
                                        '<td>'+
                                            '<div class="row">'+
                                            '@if (Auth::user()->rol_id == 1)'+
                                                    '<form onsubmit="return confirm(`Cancelar esta venta?`)" action="/sale/'+element.id+'" method="post">'+
                                                        '@csrf'+
                                                        '@method("delete")'+
                                                        '<button type="submit" class="btn btn-outline-danger btn-sm  mx-2" data-type="delete">'+
                                                            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
                                                                '<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>'+
                                                            '</svg>'+
                                                            '<small>CANCELAR</small>'+
                                                        '</button> '+
                                                    '</form>'+
                                                '@endif'+
                                            '</div>'+
                                        '</td>'+
                                        '<td>'+
                                            '<a href="/sale-detail-history/'+element.id+'" class="btn btn-primary btn-sm mx-2"><small>DETALLES</small></a>'+
                                        '</td>'+
                                    '</tr>';
                            }else{
                                //estara en verde
                                let contadorPayments = 0;
                                element.payments.forEach(function(element,index){
                                    contadorPayments += parseFloat(element.deposit);
                                });
                                document.getElementById("result2").innerHTML += //'<tr>'+
                                    '<tr class="item-resultC" style="cursor: grab;" data-id="'+element.id+'">'+
                                        '<th scope="row">'+element.name+'</th>'+
                                        '<th>$'+element.cart_total+'</th>'+
                                        '<td>$'+element.payments[(element.payments.length - 1)]["leftover"]+'</td>'+
                                        '<td>$'+contadorPayments+'.00</td>'+
                                        '<td>'+element.created_at+'</td>'+
                                        '<td><div class="card" style="text-align:center; background-color:green">'+
                                        '<label style="color:white" for="status" >'+element.status_credit+'</label>'+
                                        '</div>'+
                                        '</td>'+
                                        '<td>'+
                                            '<div class="row">'+
                                            '@if (Auth::user()->rol_id == 1)'+
                                                    '<form onsubmit="return confirm(`Cancelar esta venta?`)" action="/sale/'+element.id+'" method="post">'+
                                                        '@csrf'+
                                                        '@method("delete")'+
                                                        '<button type="submit" class="btn btn-outline-danger btn-sm  mx-2" data-type="delete">'+
                                                            '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
                                                                '<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>'+
                                                            '</svg>'+
                                                            '<small>CANCELAR</small>'+
                                                        '</button> '+
                                                    '</form>'+
                                                '@endif'+
                                            '</div>'+
                                        '</td>'+
                                        '<td>'+
                                            '<a href="/sale-detail-history/'+element.id+'" class="btn btn-primary btn-sm mx-2"><small>DETALLES</small></a>'+
                                        '</td>'+
                                    '</tr>';
                            }
                        }else{
                            document.getElementById("result2").innerHTML += //'<tr>'+
                                '<tr class="item-resultC" style="cursor: grab;" data-id="'+element.id+'">'+
                                    '<th scope="row">'+element.name+'</th>'+
                                    '<th>$'+element.cart_total+'</th>'+
                                    '<td>$00.00</td>'+
                                    '<td>$00.00</td>'+
                                    '<td>'+element.created_at+'</td>'+
                                    '<td><div class="card" style="text-align:center; background-color:red">'+
                                    '<label style="color:white" for="status" >'+element.status_credit+'</label>'+
                                    '</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<div class="row">'+
                                        '@if (Auth::user()->rol_id == 1)'+
                                                '<form onsubmit="return confirm(`Cancelar esta venta?`)" action="/sale/'+element.id+'" method="post">'+
                                                    '@csrf'+
                                                    '@method("delete")'+
                                                    '<button type="submit" class="btn btn-outline-danger btn-sm  mx-2" data-type="delete">'+
                                                        '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'+
                                                            '<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>'+
                                                        '</svg>'+
                                                        '<small>CANCELAR</small>'+
                                                    '</button> '+
                                                '</form>'+
                                            '@endif'+
                                        '</div>'+
                                    '</td>'+
                                    '<td>'+
                                        '<a href="/sale-detail-history/'+element.id+'" class="btn btn-primary btn-sm mx-2"><small>DETALLES</small></a>'+
                                    '</td>'+
                                '</tr>';
                        }
                    });
                });
                //.catch(error => console.log(error));
            }else{
                $("#tabla1").prop('hidden', false);
                $("#tabla2").prop('hidden', true);
                document.getElementById("result2").innerHTML = ""
            }
        });
    });
</script>
@endpush