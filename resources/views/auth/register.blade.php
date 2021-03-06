@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar usuario</div>

                <div class="card-body">
                <form method="POST" action="{{ url('/registro') }}" class="row mx-4">
                    @csrf   
                    
                            <div class="col-md-6">
                                    <div  class="form-group">
                                    <label for="rol_id">Rol</label>
                                        <select name="rol_id" id="rol_id" class="form-control">
                                            @foreach($rols as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div  class="form-group">
                                <label for="branch_office_id">Sucursal</label>
                                    <select name="branch_office_id" id="branch_office_id" class="form-control">
                                        @foreach($branchOffices as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>  
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" value="" required />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="" required />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rfc">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" value="" required />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="curp">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curp" value="" required />
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Tel??fono</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="" required />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo electr??nico</label>
                            <input type="email" class="form-control" name="email" id="email" value="" required />
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contrae??a</label>
                            <input type="password" class="form-control" name="password" value="" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm">Confirmar contrase??a</label>
                            <input type="password" class="form-control" name="password-confirm" value="" required />
                        </div>
                    </div>
                    <div class="col mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Calle / avenida</label>
                                    <input type="text" class="form-control" name="street" id="street" value="" required />
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="int_number">N??mero interior</label>
                                    <input type="text" class="form-control" name="int_number" id="int_number" value="" />
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ext_number">N??mero exterior</label>
                                    <input type="text" class="form-control" name="ext_number" id="ext_number" value="" />
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suburb">Colonia / barrio</label>
                                    <input type="text" class="form-control" name="suburb" id="suburb" value="" required />
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code">C??digo postal</label>
                                    <input type="number" class="form-control" name="postal_code" id="postal_code" value="" required />
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">Ciudad</label>
                                    <input type="text" class="form-control" name="city" id="city" value="" required />
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="state">Estado</label>
                                <select class="form-control" type="text" name="state" id="state" value="" required>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                    <option value="Baja California">Baja California</option>
                                    <option value="Baja California sur">Baja California Sur</option>
                                    <option value="Campeche">Campeche</option>
                                    <option value="Chiapas">Chiapas</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Coahuila">Coahuila</option>
                                    <option value="Colima">Colima</option>
                                    <option value="Durango">Durango</option>
                                    <option value="Guanajuato">Guanajuato</option>
                                    <option value="Guerrero">Guerrero</option>
                                    <option value="Hidalgo">Hidalgo</option>
                                    <option value="Jalisco">Jalisco</option>
                                    <option value="Cd. M??xico">Cd. M??xico</option>
                                    <option value="Michoac??n">Michoac??n</option>
                                    <option value="Morelos">Morelos</option>
                                    <option value="Nayarit">Nayarit</option>
                                    <option value="Nuevo Le??n">Nuevo Le??n</option>
                                    <option value="Oaxaca">Oaxaca</option>
                                    <option value="Puebla">Puebla</option>
                                    <option value="Quer??taro">Quer??taro</option>
                                    <option value="Quintana Roo">Quintana Roo</option>
                                    <option value="San Luis Potos??">San Luis Potos??</option>
                                    <option value="Sinaloa">Sinaloa</option>
                                    <option value="Sonora">Sonora</option>
                                    <option value="Tabasco">Tabasco</option>
                                    <option value="Tamaulipas">Tamaulipas</option>
                                    <option value="Tlaxcala">Tlaxcala</option>
                                    <option value="Veracruz">Veracruz</option>
                                    <option value="Yucat??n">Yucat??n</option>
                                    <option value="Zacatecas">Zacatecas</option>
                                </select>

                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Pa??s</label>
                                    <input type="text" class="form-control" name="country" id="country" value="" required />
                                </div>
                            </div> 
                        </div>
                    </div>
                
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" id="cancelEditAddressButton" class="btn btn-outline-danger mx-2" >CANCELAR</button>
                        <button type="submit" id="submitEditAddressButton" class="btn btn-primary mx-2" >REGISTRAR</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush('scripts')
<!-- <script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Las contrase??as no coinciden");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script> -->
@endsection
