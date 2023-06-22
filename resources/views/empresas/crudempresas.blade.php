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
                        <label class="titulo">
                            Nombre Empresa<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="nombre" class="form-control" value="{{$empresa->nombre ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('nombre')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label class="titulo">
                            Clave empresa<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="clave" class="form-control" value="{{$empresa->clave ?? ''}}"
                            maxlength="4" onkeyup="mayus(this);">
                        @error('clave')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="titulo">
                            Nombre Nómina<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="nombre_nomina" class="form-control"
                            value="{{$empresa->nombre_nomina  ?? ''}}" onkeyup="mayus(this);">
                        @error('nombre_nomina')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            RFC (Empresa)<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="rfc" maxlength="13" minlength="12" class="form-control"
                            value="{{$empresa->rfc ?? ''}}" onkeyup="mayus(this);"
                            pattern="^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$">
                        @error('rfc')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">
                            Registro patronal<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="segurosocial" maxlength="11" class="form-control"
                            value="{{$empresa->segurosocial ?? ''}}" onkeyup="mayus(this);"
                            onkeypress="return numeros(event);">
                        @error('segurosocial')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">Registro estatal (REC)<strong class="obligatorio">*</strong></label>
                        <input type="text" name="registro_estatal" class="form-control"
                            value="{{$empresa->registro_estatal ?? ''}}" maxlength="11" onkeyup="mayus(this);">
                        @error('registro_estatal')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            Calle<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="calle" class="form-control" value="{{$empresa->calle ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('calle')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">
                            Número exterior<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="num_externo" maxlength="40" class="form-control"
                            value="{{$empresa->num_externo ?? ''}}" onkeyup="mayus(this);" ;>
                        @error('num_externo')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">Número interior</label>
                        <input type="text" name="num_interno" maxlength="40" class="form-control"
                            value="{{$empresa->num_interno ?? ''}}" onkeyup="mayus(this);" ;>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">
                            Colonia<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="colonia" class="form-control" value="{{$empresa->colonia ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('colonia')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">
                            Código postal<strong class="obligatorio">*</strong>
                        </label>
                        <input type="number" name="codigopostal" class="form-control"
                            value="{{$empresa->codigopostal ?? ''}}" maxlength="5">
                        @error('codigopostal')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="titulo">
                            Municipio<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="municipio" class="form-control" value="{{$empresa->municipio ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('municipio')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            Ciudad<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="ciudad" class="form-control" value="{{$empresa->ciudad ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('ciudad')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            País<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="pais" class="form-control" value="{{$empresa->pais ?? ''}}"
                            onkeyup="mayus(this);" onkeypress="return validar(event);">
                        @error('pais')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            Representante legal<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="representante_legal" maxlength="50" class="form-control"
                            value="{{$empresa->representante_legal ?? ''}}" onkeyup="mayus(this);"
                            onkeypress="return validar(event);">
                        @error('representante_legal')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            RFC (Representante legal) <strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="rfc_representante" maxlength="13" class="form-control"
                            value="{{$empresa->rfc_representante ?? ''}}" onkeyup="mayus(this);"
                            pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                        @error('rfc_representante')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">Teléfono<strong class="obligatorio">*</strong></label>
                        <input type="text" name="telefono" id="telefono" max="10" class="form-control telefono"
                            value="{{$empresa->telefono ?? ''}}" onkeypress="return numeros(event);">
                        @error('telefono')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">Correo electrónico<strong class="obligatorio">*</strong></label>
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
                        <label class="titulo">
                            CURP Representante Legal<strong class="obligatorio">*</strong>
                        </label>
                        <input type="text" name="curpRepresentante" class="form-control"
                            value="{{ $empresa->curpRepresentante ?? ''}}" onkeyup="mayus(this);">
                        @error('curpRepresentante')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">
                            Área Geográfica<strong class="obligatorio">*</strong>
                        </label>
                        @if(isset($empresa))
                        <select id="regionSalario" name="regionEmpresa" class="custom-select">
                            @if($empresa->region=="N/A")
                            <option selected value="N/A">-- Selecciona una opción --</option>
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
                        <label class="titulo">Factor Prima de Riesgo de Trabajo<strong
                                class="obligatorio">*</strong></label>
                        <input type="number" min="-1" max="10" step="any" name="primaRiesgo"
                            class="form-control primaRiesgo" value="{{ $empresa->primaRiesgo ?? ''}}">
                        @error('primaRiesgo')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">Fondo de Ahorro (%)<strong class="obligatorio">*</strong></label>
                        <input type="number" name="porcentajeAhorro" class="form-control porcentajeAhorro"
                            value="{{ $empresa->porcentajeAhorro ?? ''}}">
                        @error('porcentajeAhorro')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="titulo">Regimen Físcal<strong class="obligatorio">*</strong></label>
                        <input type="text" class="form-control obtenerRegimen"
                            value="{{ $empresa->descripcionRegimen ?? '' }}">
                        <input type="hidden" name="regimenFiscal" class="form-control idRegimen"
                            value="{{ $empresa->claveRegimen ?? ''}}">
                        @error('regimenFiscal')
                        <div class="alert alert-secondary">
                            {{ $message }}
                        </div>
                        @enderror
                        <div id="listadoRegimen">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" id="periodoDias">
                        <label class="titulo">Días del Periodo<strong class="obligatorio">*</strong></label>
                        <input type="number" 
                        maxlength="2" name="tipoPeriodo" 
                        class="form-control tagperiodo"
                        value="">
                    </div>
                </div>
                <div class="col-sm-2" id="periodoInicio">
                    <div class="form-group">
                        <label class="titulo">Inicio del Periodo<strong class="obligatorio">*</strong></label>
                        <input type="date" name="inicioPeriodo" class="form-control inicioPeriodo">
                    </div>
                </div>
                <div class="col-sm-2" id="finPeriodo">
                    <div class="form-group">
                        <label class="titulo">Fecha fin Periodo<strong class="obligatorio">*</strong></label>
                        <input type="date" name="fechafin" class="form-control" id="fechafin">
                    </div>
                </div>
                <div class="col-sm-2" id="pagoPeriodo">
                    <div class="form-group">
                        <label class="titulo">Fecha pago Periodo<strong class="obligatorio">*</strong></label>
                        <input type="date" name="fechapago" id="fechapago" class="form-control">
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
                                <button type="submit" name="acciones" value="primero" id="primero"
                                    class="botonesgrandes"><i class="fas fa-backward"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="acciones" value="atras" id="atras" class="botonesgrandes"><i
                                        class="fas fa-arrow-circle-left"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="acciones" value="siguiente" id="siguiente"
                                    class="botonesgrandes"><i class="fas fa-arrow-circle-right"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="acciones" value="ultimo" id="ultimo"
                                    class="botonesgrandes"><i class="fas fa-forward"></i></button>
                            </div>
                            @else
                            <div class="form-group">
                                <button type="submit" class="botonesgrandes" disabled><i
                                        class="fas fa-backward"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="botonesgrandes" disabled><i
                                        class="fas fa-arrow-circle-left"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="botonesgrandes" disabled><i
                                        class="fas fa-arrow-circle-right"></i></button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="botonesgrandes" disabled><i
                                        class="fas fa-forward"></i></button>
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
                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="botonesgrandes">
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
                                <button type="button" id="nuevo" class="botonesgrandes"> <i
                                        class="fas fa-user-plus"></i></button>
                            </div>
                            @elsecanany(['reportes'])
                            <div class="form-group">
                                <button type="button" disabled class="botonesgrandes"> <i
                                        class="fas fa-user-plus"></i></button>
                            </div>
                            @endcanany
                            @canany(['administrador','capturista'])
                            @if(isset($empresa))
                            <div class="form-group">
                                <button type="button" id="actualizar" class="botonesgrandes"> <i
                                        class="fas fa-pen-square"></i></button>
                            </div>
                            @else
                            <div class="form-group">
                                <button type="button" disabled class="botonesgrandes"> <i
                                        class="fas fa-pen-square"></i></button>
                            </div>
                            @endif
                            @elsecanany(['reportes'])
                            <div class="form-group">
                                <button type="button" disabled class="botonesgrandes"> <i
                                        class="fas fa-pen-square"></i></button>
                            </div>
                            @endcanany
                            @can('administrador')
                            <div class="form-group">
                                @if(isset($empresa))
                                <a href="#" id="eliminar" data-target="#modal-deletenom-{{$empresa->id}}"
                                    data-toggle="modal">
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
                                <button id="guardar_falso" disabled class="botonesgrandes"><i
                                        class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit"
                                    style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button name="acciones" value="actualizar" id="actualizar_reg" type="submit"
                                    style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                            </div>
                            <div class="form-group">
                                <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" disabled
                                    class="botonesgrandes"><i class="far fa-window-close"></i></button>
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