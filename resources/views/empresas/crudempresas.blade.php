@extends('layouts.principal')
@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Nóminas</h3>
    </div>
    @if(session()->has('busqueda'))
        <div class="alert alert-danger" role="alert">
            {{ session('busqueda')}}
        </div>
    @endif
    @if(session()->has('clavesExistentes'))
        <div class="alert alert-danger" role="alert">
            {{ session('clavesExistentes')}}
        </div>
    @endif
    <div class="card-body">
        <form action="{{ route('nominas.empresas')}}" method="GET" autocomplete="off">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            Nombre empresa <strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="nombre"  class="form-control" value="{{$empresa->nombre ?? ''}}" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('nombre')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>
                            Clave empresa<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="clave" class="form-control" value="{{$empresa->clave ?? ''}}" maxlength="4" onkeyup="mayus(this);">
                            @error('clave')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>
                            Nombre Nómina<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="nombre_nomina" class="form-control" value="{{$empresa->nombre_nomina  ?? ''}}" onkeyup="mayus(this);">
                            @error('nombre_nomina')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            RFC (Empresa)<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control" value="{{$empresa->rfc ?? ''}}" onkeyup="mayus(this);" pattern="^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$">
                            @error('rfc')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Registro patronal<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="segurosocial" maxlength="11" class="form-control" value="{{$empresa->segurosocial ?? ''}}" onkeyup="mayus(this)"; onkeypress="return numeros(event)">
                            @error('segurosocial')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Registro estatal ( REC )<strong style="color: red">*</strong></label>
                            <input type="text" name="registro_estatal" class="form-control" value="{{$empresa->registro_estatal ?? ''}}" maxlength="11"onkeyup="mayus(this);">
                            @error('registro_estatal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            Calle<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="calle" class="form-control" value="{{$empresa->calle ?? ''}}" onkeyup="mayus(this)"; onkeypress="return validar(event)">
                            @error('calle')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Número exterior<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="num_externo" maxlength="40" class="form-control" value="{{$empresa->num_externo ?? ''}}" onkeyup="mayus(this)";>
                            @error('num_externo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Número interior</label>
                            <input type="text" name="num_interno" maxlength="40" class="form-control" value="{{$empresa->num_interno ?? ''}}" onkeyup="mayus(this)";>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Colonia<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="colonia" class="form-control" value="{{$empresa->colonia ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('colonia')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Código postal<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="codigopostal" class="form-control" value="{{$empresa->codigopostal ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)" maxlength="5">
                            @error('codigopostal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>
                            Municipio<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="municipio" class="form-control" value="{{$empresa->municipio ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('municipio')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            Ciudad<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="ciudad" class="form-control" value="{{$empresa->ciudad ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('ciudad')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            País<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="pais" class="form-control" value="{{$empresa->pais ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('pais')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            Representante legal<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="representante_legal" maxlength="50" class="form-control" value="{{$empresa->representante_legal ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            @error('representante_legal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            RFC (Representante legal)<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="rfc_representante" maxlength="13" class="form-control" value="{{$empresa->rfc_representante ?? ''}}" onkeyup="mayus(this);" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                            @error('rfc_representante')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                       </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Teléfono <strong style="color: red">*</strong></label>
                        
                            <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono" value="{{$empresa->telefono ?? ''}}" onkeypress="return numeros(event)">
                            @error('telefono')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Correo electrónico <strong style="color: red">*</strong></label>
                            <input type="email" name="email" class="form-control" value="{{$empresa->email ?? ''}}">
                            @error('email')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>
                            CURP Representante Legal<strong style="color: red">*</strong>
                        </label>
                            <input type="text" name="curpRepresentante" class="form-control" value="{{ $empresa->curpRepresentante ?? ''}}" >
                            @error('curpRepresentante')
                            <div class="alert alert-secondary">
                                {{ $message }}
                            </div>
                            @enderror
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
                            <input type="number" min="-1" max="10" step="any" name="primaRiesgo" class="form-control primaRiesgo" value="{{ $empresa->primaRiesgo ?? ''}}">
                            @error('primaRiesgo')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fondo de Ahorro (%)<strong style="color: red">*</strong></label>
                            <input type="number" name="porcentajeAhorro" class="form-control porcentajeAhorro" value="{{ $empresa->porcentajeAhorro ?? ''}}">
                            @error('porcentajeAhorro')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Regimen Fiscal<strong style="color: red">*</strong></label>               
                            <input type="text" class="form-control obtenerRegimen" value="{{ $empresa->descripcionRegimen ?? '' }}">
                            <input type="hidden" name="regimenFiscal"  class="form-control idRegimen"  value="{{ $empresa->claveRegimen ?? ''}}">
                            @error('regimenFiscal')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div id="listadoRegimen">

                        </div>
                    </div>
                </div>

                <!--Manejo de periodo-->
                <div class="col-sm-2">
                    <div class="form-group" id="periodoDias">
                        <label>Días del Periodo<strong style="color: red">*</strong></label>
                            <input type="number" maxlength="2" name="tipoPeriodo" class="form-control tagperiodo" value="{{ $empresa->tipoPeriodo ?? ''}}">
                    </div>
                </div>

                
                <div class="col-sm-2" id="periodoInicio">
                    <div class="form-group">
                        <label>Inicio del Periodo<strong style="color: red">*</strong></label>
                            <input type="date" name="inicioPeriodo" class="form-control inicioPeriodo">
                    </div>
                </div>                
                <div class="col-sm-2" id="finPeriodo">
                    <div class="form-group">
                        <label>Fecha fin periodo<strong style="color: red">*</strong></label>
                            <input type="date" name="fechafin" class="form-control" id="fechafin">
                    </div>
                </div>
                <div class="col-sm-2" id="pagoPeriodo">
                    <div class="form-group">
                        <label>Fecha pago periodo<strong style="color: red">*</strong></label>
                            <input type="date" name="fechapago" id="fechapago" class="form-control">
                    </div>
                </div>
            </div><!--fIN INPUTS-->
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
            </div><!--Fin botones-->
        </form><!--Fin form -->
        @isset($empresa)
            @include('empresas.modaldelete')
            @include('empresas.buscarnomina')
        @endisset
    </div><!--Fin card Body-->
</div><!--Fin card-->
@endsection