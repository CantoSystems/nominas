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
            <meta name="csrf-token" content="{{ csrf_token() }}">
    		<div class="row">
    			<div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            Nombre empresa <strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="nombre"  class="form-control" value="{{$empresa->nombre}}" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('nombre')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="nombre"  class="form-control" onkeyup="mayus(this)"; onkeypress="return validar(event)">
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
                        <label>
                            Clave <strong style="color: red">*</strong>
                        </label>
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            Nombre Nómina<strong style="color: red">*</strong>
                        </label>
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
                        <label>
                            RFC (Empresa)<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control" value="{{$empresa->rfc}}" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$">
                            @error('rfc')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control" value="" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$">
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
                        <label>
                            Registro patronal<strong style="color: red">*</strong>
                        </label>
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
                        <label>Registro estatal ( REC )</label>
                        @if(isset($empresa))
                            <input type="text" name="registro_estatal" class="form-control" value="{{$empresa->registro_estatal}}" maxlength="11"onkeyup="mayus(this);">
                        @else
                            <input type="text" name="registro_estatal" class="form-control" value="" maxlength="11"onkeyup="mayus(this);">
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            Calle<strong style="color: red">*</strong>
                        </label>
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
                        <label>
                            Número exterior<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="num_externo" maxlength="40" class="form-control" value="{{$empresa->num_externo}}" onkeyup="mayus(this)";>
                            @error('num_externo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="num_externo" maxlength="40" class="form-control" onkeyup="mayus(this)";>
                            @error('num_externo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interior</label>
                        @if(isset($empresa))
                            <input type="text" name="num_interno" maxlength="40" class="form-control" value="{{$empresa->num_interno}}" onkeyup="mayus(this)";>
                        @else
                            <input type="text" name="num_interno" maxlength="40" class="form-control" onkeyup="mayus(this)";>
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Colonia<strong style="color: red">*</strong>
                        </label>
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
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Código postal<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="codigopostal" class="form-control" value="{{$empresa->codigopostal}}" onkeyup="mayus(this);" onkeypress="return validar(event)" maxlength="5">
                            @error('codigopostal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="codigopostal" class="form-control" onkeyup="mayus(this);" maxlength="5">
                            @error('codigopostal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Municipio<strong style="color: red">*</strong>
                        </label>
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
                        <label>
                            Ciudad<strong style="color: red">*</strong>
                        </label>
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
                        <label>
                            País<strong style="color: red">*</strong>
                        </label>
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
                        <label>
                            Representante legal<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="representante_legal" maxlength="50" class="form-control" value="{{$empresa->representante_legal}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('representante_legal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="text" name="representante_legal" maxlength="50" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
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
                        <label>
                            RFC (Representante legal)<strong style="color: red">*</strong>
                        </label>
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Teléfono</label>
                        @if(isset($empresa))
                            <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="{{$empresa->telefono}}" onkeypress="return numeros(event)">
                        @else
                            <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="" onkeypress="return numeros(event)">
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        @if(isset($empresa))
                            <input type="email" name="email" class="form-control" value="{{$empresa->email}}">
                        @else
                            <input type="email" name="email" class="form-control" value="">
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            CURP Representante Legal<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <input type="text" name="curpRepresentante" class="form-control" value="{{ $empresa->curpRepresentante}}" >
                            @error('curpRepresentante')
                            <div class="alert alert-secondary">
                                {{ $message }}
                            </div>
                        @enderror
                        @else
                            <input type="text" name="curpRepresentante" class="form-control">
                            @error('curpRepresentante')
                            <div class="alert alert-secondary">
                                {{ $message }}
                            </div>
                        @enderror
                        @endif
                    </div>
                </div>
               
              
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            Área Geográfica<strong style="color: red">*</strong>
                        </label>
                        @if(isset($empresa))
                            <select id="regionSalario" name="regionEmpresa" class="custom-select">
                                @if($empresa->region=="N/A")
                                    <option selected value="N/A">Selecciona una opción</option>
                                    <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                    <option value="Resto">Resto del país</option>
                                @elseif($empresa->region=="Frontera")
                                    <option value="N/A">Selecciona una opción</option>
                                    <option selected value="Frontera">Zona Libre de la Frontera Norte</option>
                                    <option value="Resto">Resto del país</option>
                                @elseif($empresa->region=="Resto")
                                    <option value="N/A">Selecciona una opción</option>
                                    <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                    <option selected value="Resto">Resto del país</option>
                                @endif
                            </select>
                            @error('regionEmpresa')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <select id="regionSalario" name="regionEmpresa" class="custom-select">
                                <option value="N/A">Selecciona una opción</option>
                                <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                <option selected value="Resto">Resto del país</option>
                            </select>
                            @error('regionEmpresa')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Factor Prima de Riesgo de Trabajo<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="number" min="-1" max="10" step="any" name="primaRiesgo" class="form-control primaRiesgo" value="{{ $empresa->primaRiesgo }}">
                            @error('primaRiesgo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="number" min="-1" max="10" step="any" name="primaRiesgo" class="form-control primaRiesgo">
                            @error('primaRiesgo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fondo de Ahorro (%)<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="number" name="porcentajeAhorro" class="form-control porcentajeAhorro" value="{{ $empresa->porcentajeAhorro }}">
                            @error('porcentajeAhorro')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="number" name="porcentajeAhorro" class="form-control porcentajeAhorro">
                            @error('porcentajeAhorro')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Regimen Fiscal<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="text" class="form-control obtenerRegimen" value="{{ $empresa->descripcionRegimen }}">
                            <input type="hidden" name="regimenFiscal"  class="form-control idRegimen"  value="{{ $empresa->claveRegimen }}">
                            @error('regimenFiscal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                        <input type="text" class="form-control obtenerRegimen">
                        <input type="hidden" name="regimenFiscal"  class="form-control idRegimen">
                            @error('regimenFiscal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        <div id="listadoRegimen">

                        </div>
                    </div>
                </div>
               
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Días del Periodo<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="number" maxlength="2" name="tipoPeriodo" class="form-control tagperiodo" value="{{ $empresa->tipoPeriodo }}">
                            @error('tipoPeriodo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="number" maxlength="2" name="tipoPeriodo" class="form-control tagperiodo ">
                            @error('tipoPeriodo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Inicio del Periodo<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="date" name="inicioPeriodo" class="form-control" value="{{ $empresa->inicioPeriodo }}">
                            @error('inicioPeriodo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @else
                            <input type="date" name="inicioPeriodo" class="form-control">
                            @error('inicioPeriodo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="col-sm-2" id="finPeriodo">
                    <div class="form-group">
                        <label>Fin del periodo<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="date" name="fechapago" class="form-control">
                        @else
                            <input type="date" name="fechapago" class="form-control">
                        @endif
                    </div>
                </div>

                <div class="col-sm-2" id="pagoPeriodo">
                    <div class="form-group">
                        <label>Fecha pago periodo<strong style="color: red">*</strong></label>
                        @if(isset($empresa))
                            <input type="date" name="fechapago" class="form-control">
                        @else
                            <input type="date" name="fechapago" class="form-control">
                        @endif
                    </div>
                </div>
                
            </div>
            <div class="row">
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
                                        <button type="button" id="actualizar" class="botonesgrandes"> <i class="fas fa-pen-square"></i></button>
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