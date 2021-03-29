@extends('layouts.principal')
@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Nóminas</h3>
    </div>
    <div class="card-body">
         @if(session()->has('busqueda'))
            <div class="alert alert-danger" role="alert">
                 {{ session('busqueda')}}
            </div>
        @endif
        <form action="{{ route('nominas.empresas')}}" method="GET" autocomplete="off">
    		<div class="row">
    			<div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        @if(isset($empresa))
                            <input type="text" name="nombre"  class="form-control" value="{{$empresa->nombre}}" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('nombre')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="nombre"  class="form-control" value="" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('nombre')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>    
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Clave:</label>
                        @if(isset($empresa))
                            <input type="text" name="clave" class="form-control" value="{{$empresa->clave}}" maxlength="4" onkeyup="mayus(this);">
                            @error('clave')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="clave" class="form-control" value=""  maxlength="4" 
                            onkeyup="mayus(this);">
                            @error('clave')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                 <div class="col-sm-5">
                    <div class="form-group">
                        <label>Nombre Nómina:</label>
                        @if(isset($empresa))
                            <input type="text" name="nombre_nomina" class="form-control" value="{{$empresa->nombre_nomina}}" onkeyup="mayus(this);">
                            @error('nombre_nomina')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="nombre_nomina" class="form-control" value="" onkeyup="mayus(this);">
                            @error('nombre_nomina')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Empresa):</label>
                        @if(isset($empresa))
                            <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control" value="{{$empresa->rfc}}" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                            @error('rfc')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control" value="" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                            @error('rfc')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Seguro social:</label>
                        @if(isset($empresa))
                            <input type="text" name="segurosocial" maxlength="11" class="form-control" value="{{$empresa->segurosocial}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                            @error('segurosocial')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="segurosocial" maxlength="11" class="form-control" value="" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                            @error('segurosocial')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Registro estatal ( REC ):</label>
                        @if(isset($empresa))
                            <input type="text" name="registro_estatal" class="form-control" value="{{$empresa->registro_estatal}}" maxlength="11"onkeyup="mayus(this);">
                            @error('registro_estatal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="registro_estatal" class="form-control" value="" maxlength="11"onkeyup="mayus(this);">
                            @error('registro_estatal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Calle:</label>
                        @if(isset($empresa))
                            <input type="text" name="calle" class="form-control" value="{{$empresa->calle}}" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('calle')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="calle" class="form-control" value="" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('calle')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interno:</label>
                        @if(isset($empresa))
                            <input type="text" name="num_interno" max="6000" min="1" class="form-control" value="{{$empresa->num_interno}}" onkeypress="return numeros(event)">
                            @error('num_interno')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="num_interno" max="6000" min="1" class="form-control" value="" onkeypress="return numeros(event)">
                            @error('num_interno')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número externo:</label>
                        @if(isset($empresa))
                            <input type="text" name="num_externo" class="form-control" value="{{$empresa->num_externo}}" onkeypress="return numeros(event)">
                            @error('num_externo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="num_externo" class="form-control" value="" onkeypress="return numeros(event)">
                            @error('num_externo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Colonia:</label>
                        @if(isset($empresa))
                            <input type="text" name="colonia" class="form-control" value="{{$empresa->colonia}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('colonia')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="colonia" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('colonia')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Municipio:</label>
                        @if(isset($empresa))
                            <input type="text" name="municipio" class="form-control" value="{{$empresa->municipio}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('municipio')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="municipio" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('municipio')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Ciudad:</label>
                        @if(isset($empresa))
                            <input type="text" name="ciudad" class="form-control" value="{{$empresa->ciudad}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('ciudad')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="ciudad" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('ciudad')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>País:</label>
                        @if(isset($empresa))
                            <input type="text" name="pais" class="form-control" value="{{$empresa->pais}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('pais')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="pais" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('pais')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Representante legal:</label>
                        @if(isset($empresa))
                            <input type="text" name="representante_legal" maxlength="20" class="form-control" value="{{$empresa->representante_legal}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('representante_legal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="representante_legal" maxlength="20" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('representante_legal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>RFC (Representante legal):</label>
                        @if(isset($empresa))
                            <input type="text" name="rfc_representante" maxlength="13" class="form-control" value="{{$empresa->rfc_representante}}" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                            @error('rfc_representante')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="rfc_representante" maxlength="13" class="form-control" value="" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                            @error('rfc_representante')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Teléfono:</label>
                        @if(isset($empresa))
                            <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="{{$empresa->telefono}}" onkeypress="return numeros(event)">
                            @error('telefono')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="" onkeypress="return numeros(event)">
                            @error('telefono')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Correo electrónico:</label>
                        @if(isset($empresa))
                            <input type="email" name="email" class="form-control" value="{{$empresa->email}}">
                            @error('email')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="email" name="email" class="form-control" value="">
                            @error('email')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tipo de Periodo:</label>
                        @if(isset($empresa))
                            @if($empresa->tipoPeriodo == "N/A")
                                <select id="tipoPeriodo" name="tipoPeriodo" class="form-control">
                                    <option value="N/A" selected>Seleccione una opción:</option>
                                    <option value="S">Semanal</option>
                                    <option value="Q">Quincenal</option>
                                    <option value="M">Mensual</option>
                                </select>
                            @elseif($empresa->tipoPeriodo == "S")
                                <select id="tipoPeriodo" name="tipoPeriodo" class="form-control">
                                    <option value="N/A">Seleccione una opción:</option>
                                    <option value="S" selected>Semanal</option>
                                    <option value="Q">Quincenal</option>
                                    <option value="M">Mensual</option>
                                </select>
                            @elseif($empresa->tipoPeriodo == "Q")
                                <select id="tipoPeriodo" name="tipoPeriodo" class="form-control">
                                    <option value="N/A">Seleccione una opción:</option>
                                    <option value="S">Semanal</option>
                                    <option value="Q" selected>Quincenal</option>
                                    <option value="M">Mensual</option>
                                </select>
                            @elseif($empresa->tipoPeriodo == "M")
                                <select id="tipoPeriodo" name="tipoPeriodo" class="form-control">
                                    <option value="N/A">Seleccione una opción:</option>
                                    <option value="S">Semanal</option>
                                    <option value="Q">Quincenal</option>
                                    <option value="M" selected>Mensual</option>
                                </select>
                            @endif
                        @else
                            <select id="tipoPeriodo" name="tipoPeriodo" class="form-control">
                                <option value="N/A" selected>Seleccione una opción:</option>
                                <option value="S">Semanal</option>
                                <option value="Q">Quincenal</option>
                                <option value="M">Mensual</option>
                            </select>
                        @endif
                    </div>
                </div>
                @canany(['administrador','capturista','reportes'])
                    <div class="col-sm-5">
                        <div class="margin">
                            <div class="btn-group">
                                @if(isset($empresa))
                                    <div class="form-group">
                                        <button type="submit"  name="acciones" value="primero" id="primero" class="botonesgrandes"><i class="fas fa-backward" ></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="atras" id="atras" class="botonesgrandes"><i class="fas fa-arrow-circle-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botonesgrandes"><i class="fas fa-arrow-circle-right"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botonesgrandes"><i class="fas fa-forward"></i></button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <button type="submit" class="botonesgrandes" disabled><i class="fas fa-backward" ></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-right"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="botonesgrandes" disabled><i class="fas fa-forward"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endcanany
                <div class="col-md-5">
                    <div class="margin">
                        <div class="btn-group">
                            @canany(['administrador','capturista','reportes'])
                                @if(isset($empresa))
                                    <div class="form-group">
                                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botonesgrandes">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                @else 
                                    <div class="form-group">
                                        <button id="buscar_falso" type="button" class="botonesgrandes" disabled>
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                @endif
                            @endcanany
                            @canany(['administrador','capturista'])
                                <div class="form-group">
                                    <button type="button" id="nuevo" class="botonesgrandes"> <i class="fas fa-user-plus"></i></button>
                                </div>
                            @elsecanany(['reportes'])
                                <div class="form-group">
                                    <button type="button" disabled class="botonesgrandes"> <i class="fas fa-user-plus"></i></button>
                                </div>
                            @endcanany
                            @canany(['administrador','capturista'])
                                @if(isset($empresa))
                                    <div class="form-group">
                                        <button type="button" id="actualizar" class="botonesgrandes" style="background-color: red"> <i class="fas fa-pen-square"></i></button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <button type="button" disabled class="botonesgrandes"> <i class="fas fa-pen-square"></i></button>
                                    </div>
                                @endif
                            @elsecanany(['reportes'])
                                <div class="form-group">
                                    <button type="button" disabled class="botonesgrandes"> <i class="fas fa-pen-square"></i></button>
                                </div>
                            @endcanany
                            @can('administrador')
                                <div class="form-group">
                                    @if(isset($empresa))
                                        <a href="#" id="eliminar" data-target="#modal-deletenom-{{$empresa->id}}" data-toggle="modal">
                                            <button type="button" class="botonesgrandes">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </a>
                                    @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" disabled class="botonesgrandes">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @elsecanany(['capturista','reportes'])
                                <div class="form-group">
                                    <a id="eliminar_">
                                        <button type="button" disabled class="botonesgrandes">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div> 
                <div class="col-sm-2">
                    <div class="margin">
                        <div class="btn-group">
                            <!--Su uso solo es para visualizar la existencia del los iconos -->
                            <div class="form-group">
                                <button id="guardar_falso" disabled class="botonesgrandes"><i class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" disabled class="botonesgrandes"><i class="far fa-window-close"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </form>
        @isset($empresa)
            @include('empresas.modaldelete')
            @include('empresas.buscarnomina')
        @endisset
   	</div> 	
</div>	
@endsection