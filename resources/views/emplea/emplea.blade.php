@extends('layouts.plantillaEmpleados')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title modalPersonalizado">Empleados &nbsp;&nbsp;&nbsp;</h3>
                <center>
                    {{$persona->nombre ?? ''}}
                    {{$persona->apellido_paterno ?? ''}}
                    {{$persona->apellido_materno ?? ''}}
                </center>


            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <li>Registro sin éxito, es necesario rellenar los campos obligatorios</li>
                    </ul>
                </div>
                @endif
                <div class="margin">
                    <div class="card card-secondary card-tabs">
                        <!--INICIO Cabeceras-->
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-personal-tab" data-toggle="pill"
                                        href="#custom-tabs-one-personal" role="tab"
                                        aria-controls="custom-tabs-one-personal" aria-selected="true">Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-dos-perfil-tab" data-toggle="pill"
                                        href="#custom-tabs-dos-perfil" role="tab" aria-controls="custom-tabs-dos-perfil"
                                        aria-selected="false">Personal 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-tres-perosnal3-tab" data-toggle="pill"
                                        href="#custom-tabs-tres-personal3" role="tab"
                                        aria-controls="custom-tabs-tres-personal3" aria-selected="false">Personal 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-cuatro-contratacion-tab" data-toggle="pill"
                                        href="#custom-tabs-cuatro-contratacion" role="tab"
                                        aria-controls="custom-tabs-cuatro-contratacion"
                                        aria-selected="false">Contratación</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-cinco-referencias-tab" data-toggle="pill"
                                        href="#custom-tabs-cinco-referencias" role="tab"
                                        aria-controls="custom-tabs-cinco-referencias" aria-selected="false">Referencias</a>
                                </li>
                            </ul>
                        </div>
                        <!--Final Cabeceras-->

                        <!--Inicio contenido-->
                        <form method="GET" action="{{ route('emplea.index')}}">
                            <div class="card-body">
                                <!--General TABCONTENT-->
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <!--Inicio Personal-->
                                    <div class="tab-pane fade show active" id="custom-tabs-one-personal" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-personal-tab">
                                        <!--Inicio FORM-->
                                        <!--Personal 1-->
                                        <div class="form-row">
                                            <div class="col-md-1 mb-2">
                                                <label class="titulo">Clave</label>
                                                <input type="text" class="form-control" name="clave_empleado"
                                                    maxlength="4" onkeyup="mayus(this);"
                                                    value="{{ $persona->clave_empleado ?? ''}}">
                                                <input type="hidden" class="form-control" name="id_emp"
                                                    value="{{ $persona->id_emp ?? ''}}">
                                                @error('clave_empleado')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="titulo">Clasificación </label>
                                                <input type="text" class="form-control" name="clasificacion"
                                                    value="{{$persona->clasificacion ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Nombre <strong
                                                        class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control" name="nombre"
                                                    onkeyup="mayus(this);" value="{{$persona->nombre ?? ''}}"
                                                    onkeypress="return validar(event)">
                                                @error('nombre')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Apellido Paterno <strong
                                                        class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control" name="apellido_paterno"
                                                    onkeyup="mayus(this);" value="{{$persona->apellido_paterno ?? ''}}"
                                                    onkeypress="return validar(event)">
                                                @error('apellido_paterno')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Apellido Materno <strong
                                                        class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control" name="apellido_materno"
                                                    onkeyup="mayus(this);" value="{{$persona->apellido_materno ?? ''}}"
                                                    onkeypress="return validar(event)">
                                                @error('apellido_materno')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Fecha de alta <strong
                                                        class="obligatorio">*</strong></label>
                                                <input type="date" value="{{$persona->fecha_alta ?? ''}}"
                                                    class="form-control" name="fecha_alta">
                                                @error('fecha_alta')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Fecha de baja</label>
                                                <input type="date" class="form-control"
                                                    value="{{$persona->fecha_baja ?? ''}}" name="fecha_baja">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Causa de baja</label>
                                                
                                                @if(isset($persona))
                                                <select class="custom-select" name="causa_baja">
                                                    @if($persona->causa_baja=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option>Renuncia</option>
                                                    <option>Despido</option>
                                                    @elseif($persona->causa_baja=='Renuncia')
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected>Renuncia</option>
                                                    <option>Despido</option>
                                                    @elseif($persona->causa_baja=='Despido')
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option>Renuncia</option>
                                                    <option selected>Despido</option>
                                                    @endif
                                                </select>
                                                @else
                                                <select class="custom-select" name="causa_baja">
                                                    <option selected disabled value="N/A">Seleccione una opción:
                                                    </option>
                                                    <option>Renuncia</option>
                                                    <option>Despido</option>
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Departamento</label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="clave_departamento">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    @foreach ($departamentos as $depa)
                                                    @if($persona->clave_departamento==$depa->clave_departamento)
                                                    <option selected value="{{$depa->clave_departamento}}">
                                                        {{$depa->departamento}}</option>
                                                    @else
                                                    <option value="{{$depa->clave_departamento}}">
                                                        {{$depa->departamento}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                <select class="custom-select" name="clave_departamento">
                                                    <option selected disabled value="">Seleccione una opción: </option>
                                                    @foreach ($departamentos as $depa)
                                                    <option value="{{$depa->clave_departamento}}">
                                                        {{$depa->departamento}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Puesto</label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="clave_puesto">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    @foreach ($puestos as $puest)
                                                    @if($persona->clave_puesto==$puest->clave_puesto)
                                                    <option selected value="{{$puest->clave_puesto}}">
                                                        {{$puest->nombre_puesto}}</option>
                                                    @else
                                                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @else
                                                <select class="custom-select" name="clave_puesto">
                                                    <option selected disabled value="">Seleccione una opción:<strong
                                                            class="obligatorio">*</strong></option>
                                                    @foreach ($puestos as $puest)
                                                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <label class="titulo">RFC <strong class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control" value="{{$persona->rfc ?? ''}}"
                                                    maxlength="13" name="rfc" onkeyup="mayus(this);"
                                                    pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                                                @error('rfc')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="titulo">CURP <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control" value="{{$persona->curp ?? ''}}"
                                                    minlength="18" maxlength="18" name="curp" onkeyup="mayus(this);">
                                                @error('curp')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">IMSS <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control" value="{{$persona->imss ?? ''}}"
                                                    maxlength="11" name="imss" onkeypress="return numeros(event)">
                                                @error('imss')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Afore</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->afore ?? ''}}" name="afore">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">INE <strong class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control" value="{{$persona->ine ?? ''}}"
                                                    maxlength="18" name="ine" onkeyup="mayus(this);">
                                                @error('ine')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Crédito Infonavit</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->credito_infonavit ?? ''}}" maxlength="6" name="credito_infonavit"
                                                    onkeyup="mayus(this);">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Crédito Fonacot</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->credito_fonacot ?? ''}}" maxlength="10" name="credito_fonacot"
                                                    onkeyup="mayus(this);">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Licencia</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->licencia ?? ''}}" maxlength="5" name="licencia"
                                                    onkeyup="mayus(this);">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Documento migratorio</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->documento_migratorio ?? ''}}"
                                                    name="documento_migratorio" maxlength="13" onkeyup="mayus(this);">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Calle <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->calle ?? ''}}" name="calle"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('calle')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Número externo <strong
                                                        class="obligatorio">*</strong></label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->numero_externo ?? ''}}" name="numero_externo"
                                                    maxlength="4" onkeypress="return numeros(event)">
                                                @error('numero_externo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Número interno</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->numero_interno ?? ''}}" name="numero_interno"
                                                    maxlength="4" onkeypress="return numeros(event)">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Colonia <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->colonia ?? ''}}" name="colonia"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('colonia')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">CP <strong class="obligatorio">*</strong> </label>
                                                <input type="text" class="form-control" value="{{$persona->cp ?? ''}}"
                                                    name="cp" maxlength="6" onkeypress="return numeros(event)">
                                                @error('cp')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Ciudad <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->ciudad ?? ''}}" name="ciudad"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('ciudad')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Municipio <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->municipio ?? ''}}" name="municipio"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('municipio')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Estado <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->estado ?? ''}}" name="estado"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('estado')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Teléfono <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control telefono_empleado"
                                                    value="{{$persona->telefono_empleado ?? ''}}"
                                                    name="telefono_empleado" onkeypress="return numeros(event)">
                                                @error('telefono_empleado')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Correo <strong class="obligatorio">*</strong>
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->correo?? ''}}" name="correo">
                                                @error('correo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Sexo <strong class="obligatorio">*</strong>
                                                </label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="sexo">
                                                    @if($persona->sexo=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="HOMBRE">Hombre</option>
                                                    <option value="MUJER">Mujer</option>
                                                    @elseif($persona->sexo=="HOMBRE")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="HOMBRE">Hombre</option>
                                                    <option value="MUJER">Mujer</option>
                                                    @elseif($persona->sexo=="MUJER")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="HOMBRE">Hombre</option>
                                                    <option selected value="MUJER">Mujer</option>
                                                    @endif
                                                </select>
                                                @error('sexo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="sexo">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="HOMBRE">Hombre</option>
                                                    <option value="MUJER">Mujer</option>
                                                </select>
                                                @error('sexo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Estado Civil <strong
                                                        class="obligatorio">*</strong> </label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="estado_civil">
                                                    @if($persona->estado_civil=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="SOLTERO">Soltero</option>
                                                    <option value="CASADO">Casado</option>
                                                    @elseif($persona->estado_civil=="SOLTERO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="SOLTERO">Soltero</option>
                                                    <option value="CASADO">Casado</option>
                                                    @elseif($persona->estado_civil=="CASADO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="SOLTERO">Soltero</option>
                                                    <option selected value="CASADO">Casado</option>
                                                    @endif
                                                </select>
                                                @error('estado_civil')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="estado_civil">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="SOLTERO">Soltero</option>
                                                    <option value="CASADO">Casado</option>
                                                </select>
                                                @error('estado_civil')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Nacionalidad <strong
                                                        class="obligatorio">*</strong> </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->nacionalidad ?? ''}}" name="nacionalidad"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('nacionalidad')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Tipo de sangre  </label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->tipo_sangre ?? ''}}" name="tipo_sangre"
                                                    onkeyup="mayus(this);" onkeypress="return validasangre(event)">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="titulo">Alergias</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->alergias ?? ''}}" name="alergias"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                <label class="titulo">Nacimiento <strong style="color:red">*</strong>
                                                </label>
                                                <input type="date" class="form-control"
                                                    value="{{$persona->fecha_nacimiento ?? ''}}"
                                                    name="fecha_nacimiento">
                                                @error('fecha_nacimiento')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!--Fin  Row Personal-->
                                    <!--Inicio Personal 2-->
                                    <div class="tab-pane fade" id="custom-tabs-dos-perfil" role="tabpanel"
                                        aria-labelledby="custom-tabs-dos-perfil-tab-tab">
                                        <div class="form-row">
                                            <div class="col-md-2 mb-2">
                                                <label class="titulo">Enfermedad Crónica</label>
                                                <input type="text" class="form-control" name="enfermedad_cronica"
                                                    value="{{$persona->enfermedad_cronica ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="titulo">Práctica de Deportes</label>
                                                <input type="text" class="form-control" name="deporte"
                                                    value="{{$persona->deporte ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Pasatiempos</label>
                                                <input type="text" class="form-control" name="pasatiempo"
                                                    value="{{$persona->deporte ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Asociación, Club Social o Deportivo</label>
                                                <input type="text" class="form-control" name="asosiacion"
                                                    value="{{$persona->asosiacion ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Objetivo de Vida</label>
                                                <input type="text" class="form-control" name="objetivo_vida"
                                                    value="{{$persona->objetivo_vida ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Lugar de Origen</label>
                                                <input type="text" class="form-control" name="lugar"
                                                    value="{{$persona->lugar ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">UMF </label>
                                                <input type="text" class="form-control" name="umf"
                                                    value="{{$persona->umf ?? ''}}" onkeypress="return numeros(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Nombre del Padre  </label>
                                                <input type="text" class="form-control" name="nombre_padre"
                                                    value="{{$persona->nombre_padre ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <br>
                                                @if(isset($persona))
                                                <div class="form-check">
                                                    @if($persona->finado_padre==0)
                                                    <input checked class="form-check-input" type="checkbox"
                                                        value="option1" name="finado_padre" aria-label="">
                                                    @else
                                                    <input class="form-check-input" type="checkbox" value="option1"
                                                        name="finado_padre" aria-label="">
                                                    @endif
                                                    <label class="titulo">Finado</label>
                                                </div>
                                                @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="finado_padre"
                                                        value="option1" aria-label="">
                                                    <label class="titulo">Finado</label>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Dirección</label>
                                                <input type="text" class="form-control" name="direccion_padre"
                                                    value="{{$persona->direccion_padre ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_padre"
                                                    value="{{$persona->ocupacion_padre ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Nombre de la Madre</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->nombre_madre ?? ''}}" name="nombre_madre"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <br>
                                                @if(isset($persona))
                                                <div class="form-check">
                                                    @if($persona->finado_madre==0)
                                                    <input checked class="form-check-input" type="checkbox"
                                                        name="finado_madre" value="option1" aria-label="">
                                                    @else
                                                    <input class="form-check-input" type="checkbox" name="finado_madre"
                                                        value="option1" aria-label="">
                                                    @endif
                                                    <label class="titulo">Finado</label>
                                                </div>
                                                @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="finado_madre"
                                                        value="option1" aria-label="">
                                                    <label class="titulo">Finado</label>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Dirección</label>
                                                <input type="text" class="form-control" name="direccion_madre"
                                                    value="{{$persona->direccion_madre ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Ocupación</label>
                                                <input type="text" class="form-control" name="ocupacion_madre"
                                                    value="{{$persona->ocupacion_madre ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="titulo">Nombre y edad de sus hijos</label>
                                                <input type="text" class="form-control" name="hijos"
                                                    value="{{$persona->hijos ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Idiomas</label>
                                                <input type="text" class="form-control" name="idiomas"
                                                    value="{{$persona->idiomas ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Funciones de Oficina</label>
                                                <input type="text" class="form-control" name="funciones_oficina"
                                                    value="{{$persona->funciones_oficina ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Máquinas de Oficina o Taller que Maneje </label>
                                                <input type="text" class="form-control" maxlength="20"
                                                    name="maquinas_oficina" value="{{$persona->maquinas_oficina ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Software que conoce </label>
                                                <input type="text" class="form-control" name="software"
                                                    value="{{$persona->software ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Otras funciones o trabajos que domina</label>
                                                <input type="text" class="form-control" name="otras_funciones"
                                                    value="{{$persona->otras_funciones ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                        </div>
                                        <!--Fin  Row Personal 1-->
                                    </div>
                                    <!--Fin Personal 2-->
                                    <!--Inicio Personal 3-->
                                    <div class="tab-pane fade" id="custom-tabs-tres-personal3" role="tabpanel"
                                        aria-labelledby="custom-tabs-tres-personal3-tab">
                                        <div class="form-row">
                                            <div class="col-sm-12">
                                                <div class="col-md-12 mb-3">
                                                    <h4>
                                                        <strong>Beneficiarios</strong>
                                                    </h4>
                                                </div>
                                                <div class="col-md-11 mb-3" style="text-align: right;">
                                                    <h6 id="mensaje"></h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Nombre <strong
                                                        style="color:red">*</strong></label>
                                                <input type="text" class="form-control" name="beneficiario"
                                                    value="{{$persona->beneficiario ?? ''}}" id="beneficiario"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('beneficiario')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" class="form-control" name="beneficiario1"
                                                    value="{{$persona->beneficiario1 ?? ''}}" id="beneficiario1"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="beneficiario2"
                                                    value="{{$persona->beneficiario2 ?? ''}}" id="beneficiario2"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="beneficiario3"
                                                    value="{{$persona->beneficiario3 ?? ''}}" id="beneficiario3"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="beneficiario4"
                                                    value="{{$persona->beneficiario4 ?? ''}}" id="beneficiario4"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="titulo">Parentesco <strong
                                                        style="color:red">*</strong></label>
                                                <input type="text" class="form-control" name="parentesco"
                                                    id="parentesco" value="{{$persona->parentesco ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('parentesco')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" class="form-control" name="parentesco1"
                                                    id="parentesco1" value="{{$persona->parentesco1 ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="parentesco2"
                                                    id="parentesco2" value="{{$persona->parentesco2 ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="parentesco3"
                                                    id="parentesco3" value="{{$persona->parentesco3 ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" class="form-control" name="parentesco4"
                                                    id="parentesco4" value="{{$persona->parentesco4 ?? ''}}"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">% de Participación <strong
                                                        style="color:red">*</strong></label>
                                                <input type="number" class="form-control"
                                                    value="{{$persona->porcentaje ?? ''}}" name="porcentaje" min="0.1"
                                                    max="100" step="0.01" id="porcentaje">
                                                @error('porcentaje')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="number" class="form-control"
                                                    value="{{$persona->porcentaje1 ?? ''}}" name="porcentaje1"
                                                    id="porcentaje1">
                                                <input type="number" class="form-control"
                                                    value="{{$persona->porcentaje2 ?? ''}}" name="porcentaje2"
                                                    id="porcentaje2">
                                                <input type="number" class="form-control"
                                                    value="{{$persona->porcentaje3 ?? ''}}" name="porcentaje3"
                                                    id="porcentaje3">
                                                <input type="number" class="form-control"
                                                    value="{{$persona->porcentaje4 ?? ''}}" name="porcentaje4"
                                                    id="porcentaje4">
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="titulo" style="text-align: left;">
                                                    <h4><strong>Estudios anteriores</strong></h4>
                                                </label>
                                            </div>
                                            <!--Inicio titulos-->
                                            <label class="col-form-label col-sm-2 titulo">&nbsp &nbsp &nbsp </label>
                                            <div class="col-sm-3">
                                                <label for="pensamiento_id" style="text-align: justify;">Nombre de la
                                                    Institución</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="pensamiento_id" style="text-align: justify;">Inicio &nbsp
                                                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Finalizó</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="pensamiento_id" style="text-align: justify;">Título
                                                    obtenido</label>
                                            </div>
                                            <!--Fin titulos-->
                                            <!--Inicio Primaria-->
                                            <label for="" class="col-form-label col-sm-2 titulo">Primaria </label>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->primaria ?? ''}}" name="primaria"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-4">
                                                <input value="{{$persona->duracion_primaria ?? ''}}"
                                                    name="duracion_primaria" class="form-control" id="duracion5">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->titulo_primaria ?? ''}}"
                                                    name="titulo_primaria" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Primaria-->
                                            <!--Inicio Secundaria-->
                                            <label for="" class="col-form-label col-sm-2 titulo">Secundaria</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="secundaria"
                                                    value="{{$persona->secundaria ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-4">
                                                <input name="duracion_secundaria"
                                                    value="{{$persona->duracion_secundaria ?? ''}}" class="form-control"
                                                    id="duracion6">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->titulo_secundaria ?? ''}}"
                                                    name="titulo_secundaria ?? ''" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Secundaria-->
                                            <!--Inicio Preparatoria-->
                                            <label for="" class="col-form-label col-sm-2 titulo">Preparatoria</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="preparatoria"
                                                    value="{{$persona->preparatoria ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-4">
                                                <input name="duracion_preparatoria"
                                                    value="{{$persona->duracion_preparatoria ?? ''}}"
                                                    class="form-control" id="duracion7">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="titulo_preparatoria"
                                                    value="{{$persona->titulo_preparatoria ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Preparatoria-->
                                            <!--Inicio Profesional-->
                                            <label for="" class="col-form-label col-sm-2 titulo">Profesional</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="profesional"
                                                    value="{{$persona->profesional ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-4">
                                                <input name="duracion_profesional"
                                                    value="{{$persona->duracion_profesional ?? ''}}"
                                                    class="form-control" id="duracion8">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="titulo_profesional"
                                                    value="{{$persona->titulo_profesional ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Profesional-->
                                            <!--Inicio Otras-->
                                            <label for="" class="col-form-label col-sm-2 titulo">Otras</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="otras" value="{{$persona->otras ?? '' }}"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-4">
                                                <input name="duracion_otras" value="{{$persona->duracion_otras ?? ''}}"
                                                    class="form-control" id="duracion9">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="titulo_otras"
                                                    value="{{$persona->titulo_otras ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Profesional-->
                                            <div class="col-sm-12">
                                                <label for="" style="text-align: left;">
                                                    <br>
                                                    <h4><strong>Estudios actuales</strong></h4>
                                                </label>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="titulo">Nombre de la Institución</label>
                                                <input type="text" class="form-control" name="estudio_actual"
                                                    value="{{$persona->estudio_actual ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Curso o Carrera</label>
                                                <input type="text" class="form-control" name="carrera"
                                                    value="{{$persona->carrera ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <label class="titulo">Grado</label>
                                                <input type="number" class="form-control" name="grado"
                                                    value="{{$persona->grado ?? ''}}" min="0" max="10">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Horario</label>
                                                <input type="text" class="form-control"
                                                    value="{{$persona->horario ?? ''}}" name="horario">
                                            </div>
                                        </div>
                                        <!--Final Row Personal 2-->
                                    </div>
                                    <!--Final Personal 3-->
                                    <!--Inicio Referencias-->
                                    <div class="tab-pane fade" id="custom-tabs-cinco-referencias" role="tabpanel"
                                        aria-labelledby="custom-tabs-cinco-referencias-tab">
                                        <!--Inicio Row Referencias-->
                                        <div class="form-row">
                                            <!--Inicio Titulos Referencias-->
                                            <div class="col-sm-12">
                                                <label for="" style="text-align: left;">
                                                    <h4><strong>Empleos</strong></h4>
                                                </label>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="" style="text-align: left;">
                                                    <h6><strong>Tiempo que prestó su servicios</strong></h6>
                                                </label>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="pensamiento_id"
                                                    style="text-align: justify;">&nbsp&nbspDe:&nbsp &nbsp &nbsp
                                                    &nbsp&nbsp</label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp
                                                    &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp
                                                    &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp
                                                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp
                                                    &nbsp&nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp
                                                    &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp
                                                    &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp
                                                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp
                                                    &nbsp&nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp
                                                    &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp
                                                    &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp
                                                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp
                                                    &nbsp&nbsp </label>
                                                <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp
                                                    &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp
                                                    &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
                                            </div>
                                            <!--Inicio Vinculación Referencias-->
                                            <div class="col-sm-3">
                                                <input name="duracion_trabajo"
                                                    value="{{$persona->duracion_trabajo ?? ''}}" class="form-control"
                                                    id="duracion">
                                                @error('duracion_trabajo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input name="duracion_trabajo1"
                                                    value="{{$persona->duracion_trabajo1 ?? ''}}" class="form-control"
                                                    id="duracion2">
                                            </div>
                                            <div class="col-sm-3">
                                                <input name="duracion_trabajo2"
                                                    value="{{$persona->duracion_trabajo2 ?? ''}}" class="form-control"
                                                    id="duracion3">
                                            </div>
                                            <div class="col-sm-3">
                                                <input name="duracion_trabajo3"
                                                    value="{{$persona->duracion_trabajo3 ?? ''}}" class="form-control"
                                                    id="duracion4">
                                            </div>
                                            <label for="" class="col-form-label col-sm-12 titulo">Nombre de la
                                                Compañia</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="nombre_compania"
                                                    value="{{$persona->nombre_compania ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('nombre_compania')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="nombre_compania1"
                                                    value="{{$persona->nombre_compania1 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="nombre_compania2"
                                                    value="{{$persona->nombre_compania2 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="nombre_compania3"
                                                    value="{{$persona->nombre_compania3 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--Fin compañia Referencias-->
                                            <!--Inicio Dirección Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Dirección</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="direccion_compania"
                                                    value="{{$persona->direccion_compania ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('direccion_compania')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="direccion1_trabajo1"
                                                    value="{{$persona->direccion1_trabajo1 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="direccion_compania2"
                                                    value="{{$persona->direccion_compania2 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="direccion3"
                                                    value="{{$persona->direccion3 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--Fin Dirección Referencias-->
                                            <!--Inicio Telefono Referencias-->
                                            <label for="" class="col-form-label col-sm-1 titulo">Télefono</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="telefono_compania"
                                                    value="{{$persona->telefono_compania ?? ''}}"
                                                    class="form-control telefono_compania" tabindex="1">
                                                @error('telefono_compania')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="telefono1"
                                                    value="{{$persona->telefono1 ?? ''}}"
                                                    class="form-control telefono1">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="telefono2"
                                                    value="{{$persona->telefono2 ?? ''}}"
                                                    class="form-control telefono2">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="telefono3"
                                                    value="{{$persona->telefono3 ?? ''}}"
                                                    class="form-control telefono3">
                                            </div>
                                            <!--FIN Telefono Referencias-->
                                            <!--INCIO sueldo Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Sueldo</label>
                                            <div class="col-sm-3">
                                                <input type="number" value="{{$persona->sueldo ?? ''}}" step="0.01"
                                                    min="0.00" max="100000.0" name="sueldo" class="form-control"
                                                    onkeypress="return numeros(event)">
                                                @error('sueldo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" value="{{$persona->sueldo1 ?? ''}}" step="0.01"
                                                    min="0.00" max="100000.0" name="sueldo1" class="form-control"
                                                    onkeypress="return numeros(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" value="{{$persona->sueldo2 ?? ''}}" step="0.01"
                                                    min="0.00" max="100000.0" name="sueldo2" class="form-control"
                                                    onkeypress="return numeros(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" value="{{$persona->sueldo3 ?? ''}}" step="0.01"
                                                    min="0.00" max="100000.0" name="sueldo3" class="form-control"
                                                    onkeypress="return numeros(event)">
                                            </div>
                                            <!--FIN sueldo Referencias-->
                                            <!--INCIO Motivo separación Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Motivo de la
                                                Separación</label>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->motivo_separacion ?? ''}}"
                                                    name="motivo_separacion" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                @error('motivo_separacion')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->motivo_separacion1 ?? ''}}"
                                                    name="motivo_separacion1" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->motivo_separacion2 ?? ''}}"
                                                    name="motivo_separacion2" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->motivo_separacion3 ?? ''}}"
                                                    name="motivo_separacion3" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Motivo separación Referencias-->
                                            <!--INCIO Jefe Directo separación Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Nombre del Jefe
                                                Directo</label>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->nombre_jefe ?? ''}}"
                                                    name="nombre_jefe" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                @error('nombre_jefe')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->nombre_jefe1 ?? ''}}"
                                                    name="nombre_jefe1" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->nombre_jefe2 ?? ''}}"
                                                    name="nombre_jefe2" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->nombre_jefe3 ?? ''}}"
                                                    name="nombre_jefe3" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Jefe Directo separación Referencias-->
                                            <!--INCIO Puesto Jefe Directo separación Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Puesto del Jefe
                                                Inmediato</label>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->puesto_jefe ?? ''}}"
                                                    name="puesto_jefe" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                @error('puesto_jefe')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->puesto_jefe1 ?? ''}}"
                                                    name="puesto_jefe1" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->puesto_jefe2 ?? '' }}"
                                                    name="puesto_jefe2" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->puesto_jefe3 ?? ''}}"
                                                    name="puesto_jefe3" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Puesto Jefe Directo separación Referencias-->
                                            <!--INCIO Informes separación Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Podemos Solicitar
                                                Informes:</label>
                                            <div class="col-sm-3">
                                                @if(isset($persona))
                                                @if($persona->solicitar_informes==0)
                                                <input checked type="checkbox" name="solicitar_informes"
                                                    class="form-control">
                                                @else
                                                <input type="checkbox" name="solicitar_informes" class="form-control">
                                                @endif
                                                @error('solicitar_informes')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <input type="checkbox" name="solicitar_informes" class="form-control">
                                                @error('solicitar_informes')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if(isset($persona))
                                                @if($persona->solicitar_informes1==0)
                                                <input checked type="checkbox" name="solicitar_informes1"
                                                    class="form-control">
                                                @else
                                                <input type="checkbox" name="solicitar_informes1" class="form-control">
                                                @endif
                                                @else
                                                <input type="checkbox" name="solicitar_informes1" class="form-control">
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if(isset($persona))
                                                @if($persona->solicitar_informes2==0)
                                                <input checked type="checkbox" name="solicitar_informes2"
                                                    class="form-control">
                                                @else
                                                <input type="checkbox" name="solicitar_informes2" class="form-control">
                                                @endif
                                                @else
                                                <input type="checkbox" name="solicitar_informes2" class="form-control">
                                                @endif
                                            </div>
                                            <div class="col-sm-3">
                                                @if(isset($persona))
                                                @if($persona->solicitar_informes3==0)
                                                <input checked type="checkbox" name="solicitar_informes3"
                                                    class="form-control">
                                                @else
                                                <input type="checkbox" name="solicitar_informes3" class="form-control">
                                                @endif
                                                @else
                                                <input type="checkbox" name="solicitar_informes3" class="form-control">
                                                @endif
                                            </div>
                                            <!--FIN Informes separación Referencias-->
                                            <!--Razones Informes separación Referencias-->
                                            <label for="" class="col-form-label col-sm-12 titulo">Razones</label>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->razones ?? ''}}" name="razones"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                @error('razones')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->razones1 ?? ''}}" name="razones1"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->razones2 ?? ''}}" name="razones2"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" value="{{$persona->razones3 ?? ''}}" name="razones3"
                                                    class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <!--FIN Razones Informes separación Referencias-->
                                            <div class="col-sm-12">
                                                <p><label for="" style="text-align: left;">
                                                        <h4><strong>Referencias Personales</strong></h4>
                                                    </label></p>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="titulo" style="text-align: left;">Nombre</label>
                                                <input type="text" name="referencia"
                                                    value="{{$persona->referencia ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('referencia')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" value="{{$persona->referencia1 ?? ''}}"
                                                    name="referencia1" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                <input type="text" value="{{$persona->referencia2 ?? ''}}"
                                                    name="referencia2" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="titulo" style="text-align: left;">Dirección</label>
                                                <input type="text" name="direccion_trabajo"
                                                    value="{{$persona->direccion_trabajo ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                @error('direccion_trabajo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" name="direccion1"
                                                    value="{{$persona->direccion1 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                                <input type="text" name="direccion2"
                                                    value="{{$persona->direccion2 ?? ''}}" class="form-control"
                                                    onkeyup="mayus(this);" onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="titulo" style="text-align: left;">Teléfono</label>
                                                <input type="text" value="{{$persona->telefono_referencia ?? ''}}"
                                                    name="telefono_referencia" class="form-control telefono_referencia">
                                                @error('telefono_referencia')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" value="{{$persona->telefono_referencia1 ?? ''}}"
                                                    name="telefono_referencia1"
                                                    class="form-control telefono_referencia1">
                                                <input type="text" value="{{$persona->telefono_referencia2 ?? ''}}"
                                                    name="telefono_referencia2"
                                                    class="form-control telefono_referencia2">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="titulo" style="text-align: left;">Ocupación</label>
                                                <input type="text" value="{{ $persona->ocupacion ?? ''}}"
                                                    name="ocupacion" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                @error('ocupacion')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" value="{{$persona->ocupacion1 ?? ''}}"
                                                    name="ocupacion1" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                                <input type="text" value="{{$persona->ocupacion2 ?? ''}}"
                                                    name="ocupacion2" class="form-control" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="titulo" style="text-align: left;">Tiempo (Años)</label>
                                                <input type="number" value="{{$persona->tiempo ?? ''}}" name="tiempo"
                                                 step="1" class="form-control" maxlength="2"
                                                    onkeypress="return numeros(event)">
                                                @error('tiempo')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="number" value="{{$persona->tiempo1 ?? ''}}" name="tiempo1"
                                                    step="1" class="form-control" maxlength="2"
                                                    onkeypress="return numeros(event)">
                                                <input type="number" value="{{$persona->tiempo2 ?? ''}}" name="tiempo2"
                                                    step="1" class="form-control" maxlength="2"
                                                    onkeypress="return numeros(event)">
                                            </div>
                                        </div>
                                        <!--Final Row Referencias-->
                                    </div>
                                    <!--Inicio Contratación-->
                                    <div class="tab-pane fade" id="custom-tabs-cuatro-contratacion" role="tabpanel"
                                        aria-labelledby="custom-tabs-cuatro-contratacion-tab">
                                        <!--Inicio Row contratación-->
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Tipo de trabajador <strong
                                                        style="color:red">*</strong></label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="tipo_trabajador">
                                                    @if($persona->tipo_trabajador=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="EMPLEADO">Administrativo</option>
                                                    <option value="PATRON">Sindicalizado</option>
                                                    @elseif($persona->tipo_trabajador=="EMPLEADO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="EMPLEADO">Administrativo</option>
                                                    <option value="PATRON">Sindicalizado</option>
                                                    @elseif($persona->tipo_trabajador=="PATRON")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="EMPLEADO">Administrativo</option>
                                                    <option selected value="PATRON">Sindicalizado</option>
                                                    @endif
                                                </select>
                                                @error('tipo_trabajador')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="tipo_trabajador">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="EMPLEADO">Administrativo</option>
                                                    <option value="PATRON">Sindicalizado</option>
                                                </select>
                                                @error('tipo_trabajador')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Turno <strong style="color:red">*</strong>
                                                </label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="turno">
                                                    @if($persona->turno=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="DIURNO">Diurno</option>
                                                    <option value="NOCTURNO">Nocturno</option>
                                                    <option value="MIXTO">Mixto</option>
                                                    @elseif($persona->turno=="DIURNO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="DIURNO">Diurno</option>
                                                    <option value="NOCTURNO">Nocturno</option>
                                                    <option value="MIXTO">Mixto</option>
                                                    @elseif($persona->turno=="NOCTURNO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="DIURNO">Diurno</option>
                                                    <option selected value="NOCTURNO">Nocturno</option>
                                                    <option value="MIXTO">Mixto</option>
                                                    @elseif($persona->turno=="MIXTO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="DIURNO">Diurno</option>
                                                    <option value="NOCTURNO">Nocturno</option>
                                                    <option selected value="MIXTO">Mixto</option>
                                                    @endif
                                                </select>
                                                @error('turno')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="turno">
                                                    <option selected disabled value="">Seleccione una opción: <strong
                                                            style="color:red">*</strong></option>
                                                    <option value="DIURNO">Diurno</option>
                                                    <option value="NOCTURNO">Nocturno</option>
                                                    <option value="MIXTO">Mixto</option>
                                                </select>
                                                @error('turno')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="titulo">Contrato <strong
                                                        style="color:red">*</strong></label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="contrato">
                                                    @if($persona->contrato=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="PRUEBA">Prueba</option>
                                                    <option value="DETERMINADO">Tiempo determinado</option>
                                                    <option value="INDETERMINADO">Tiempo indeterminado</option>
                                                    @elseif($persona->contrato=="PRUEBA")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="PRUEBA">Prueba</option>
                                                    <option value="DETERMINADO">Tiempo determinado</option>
                                                    <option value="INDETERMINADO">Tiempo indeterminado</option>
                                                    @elseif($persona->contrato=="DETERMINADO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="PRUEBA">Prueba</option>
                                                    <option selected value="DETERMINADO">Tiempo determinado</option>
                                                    <option value="INDETERMINADO">Tiempo indeterminado</option>
                                                    @elseif($persona->contrato=="INDETERMINADO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="PRUEBA">Prueba</option>
                                                    <option value="DETERMINADO">Tiempo determinado</option>
                                                    <option selected value="INDETERMINADO">Tiempo indeterminado</option>
                                                    @endif
                                                </select>
                                                @error('contrato')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="contrato">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="PRUEBA">Prueba</option>
                                                    <option value="DETERMINDO">Tiempo determinado</option>
                                                    <option value="INDETERMINADO">Tiempo indeterminado</option>
                                                </select>
                                                @error('contrato')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="titulo">Vigencia <strong
                                                        style="color:red">*</strong></label>
                                                <input type="date" class="form-control" name="vigencia"
                                                    value="{{$persona->vigencia ?? ''}}">
                                                @error('vigencia')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <br>
                                                <label class="titulo">Horario inicio <strong
                                                        style="color:red">*</strong> </label>
                                                <input type="time" class="form-control" name="horario_trabajoinicio"
                                                    value="{{$persona->horario_trabajoinicio ?? ''}}">
                                                @error('horario_trabajoinicio')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <br>
                                                <label class="titulo">Horario fin <strong
                                                        style="color:red">*</strong></label>
                                                <input type="time" class="form-control" name="horario_trabajofin"
                                                    value="{{$persona->horario_trabajofin ?? ''}}">
                                                @error('horario_trabajofin')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <br>
                                                <label class="titulo">Día descanso <strong
                                                        style="color:red">*</strong></label>
                                                @if(isset($persona))
                                                @if($persona->diadescanso_empleado == "")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "LUNES")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES" selected>Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "MARTES")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES" selected>Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "MIERCOLES")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES" selected>Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "JUEVES")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES" selected>Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "VIERNES")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES" selected>Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "SABADO")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO" selected>Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @elseif($persona->diadescanso_empleado == "DOMINGO")
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO" selected>Domingo</option>
                                                </select>
                                                @endif
                                                @else
                                                <select class="custom-select" name="diadescanso_empleado">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="LUNES">Lunes</option>
                                                    <option value="MARTES">Martes</option>
                                                    <option value="MIERCOLES">Miércoles</option>
                                                    <option value="JUEVES">Jueves</option>
                                                    <option value="VIERNES">Viernes</option>
                                                    <option value="SABADO">Sábado</option>
                                                    <option value="DOMINGO">Domingo</option>
                                                </select>
                                                @error('diadescanso_empleado')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <br>
                                                <label class="titulo">Sueldo diario <strong
                                                        style="color:red">*</strong></label>
                                                <input type="number" class="form-control" name="sueldo_diario"
                                                    value="{{$persona->sueldo_diario ?? ''}}" maxlength="5" min="0.01"
                                                    max="10000.00" step="0.01">
                                                @error('sueldo_diario')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <br>
                                                <label class="titulo">Sueldo diario integrado <strong
                                                        style="color:red">*</strong></label>
                                                <input type="number" class="form-control" name="sueldo_integrado"
                                                    value="{{$persona->sueldo_integrado ?? ''}}" maxlength="5"
                                                    min="0.01" max="10000.00" step="0.01"
                                                    onkeypress="return numeros(event)" readonly>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="titulo">Tabulación<br>Nivel</label>
                                                <input type="text" onkeyup="mayus(this);" class="form-control"
                                                    name="nivel" value="{{$persona->nivel ?? ''}}">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <br>
                                                <label class="titulo">Categoria</label>
                                                <input type="text" onkeyup="mayus(this);" class="form-control"
                                                    name="categoria" value="{{$persona->categoria ?? ''}}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <br>
                                                <label class="titulo">Tipo salario <strong style="color:red">*</strong>
                                                </label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="tipo_salario">
                                                    @if($persona->tipo_salario=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="FIJO">Fijo</option>
                                                    <option value="VARIABLE">Variable</option>
                                                    @elseif($persona->tipo_salario=="FIJO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="FIJO">Fijo</option>
                                                    <option value="VARIABLE">Variable</option>
                                                    @elseif($persona->tipo_salario=="VARIABLE")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="FIJO">Fijo</option>
                                                    <option selected value="VARIABLE">Variable</option>
                                                    @endif
                                                </select>
                                                @error('tipo_salario')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="tipo_salario">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="FIJO">Fijo</option>
                                                    <option value="VARIABLE">Variable</option>
                                                </select>
                                                @error('tipo_salario')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <br>
                                                <label class="titulo">Tipo de jornada <strong
                                                        style="color:red">*</strong> </label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="tipo_jornada">
                                                    @if($persona->tipo_jornada=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="COMPLETA">Completa</option>
                                                    <option value="REDUCIDA">Reducida</option>
                                                    @elseif($persona->tipo_jornada=="COMPLETA")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="COMPLETA">Completa</option>
                                                    <option value="REDUCIDA">Reducida</option>
                                                    @elseif($persona->tipo_jornada=="REDUCIDA")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="COMPLETA">Completa</option>
                                                    <option selected value="REDUCIDA">Reducida</option>
                                                    @endif
                                                </select>
                                                @error('tipo_jornada')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="tipo_jornada">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="COMPLETA">Completa</option>
                                                    <option value="REDUCIDA">Reducida</option>
                                                </select>
                                                @error('tipo_jornada')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <label class="titulo">Jornada <br> Días <strong
                                                        style="color:red">*</strong></label>
                                                <input type="number" value="{{$persona->dias ?? ''}}"
                                                    class="form-control" name="dias" min="1" max="30" step="1">
                                                @error('dias')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <br>
                                                <label class="titulo">Horas<strong style="color:red">*</strong></label>
                                                <input type="number" value="{{$persona->horas_diarias ?? ''}}"
                                                    class="form-control" name="horas_diarias" min="1" max="24"
                                                    step="any" value="">
                                                @error('horas_diarias')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <br>
                                                <label class="titulo">Forma de Pago <strong
                                                        style="color:red">*</strong></label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="forma_pago">
                                                    @if($persona->forma_pago=="")
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="EFECTIVO">Efectivo</option>
                                                    <option value="CHEQUE">Cheque</option>
                                                    <option value="TRANSFERENCIA">Transferencia</option>
                                                    @elseif($persona->forma_pago=="EFECTIVO")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option selected value="EFECTIVO">Efectivo</option>
                                                    <option value="TRANSFERENCIA">Transferencia</option>
                                                    <option value="CHEQUE">Cheque</option>
                                                    @elseif($persona->forma_pago=="CHEQUE")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="EFECTIVO">Efectivo</option>
                                                    <option selected value="CHEQUE">Cheque</option>
                                                    <option value="TRANSFERENCIA">Transferencia</option>
                                                    @elseif($persona->forma_pago=="CHEQUE")
                                                    <option disabled value="">Seleccione una opción:</option>
                                                    <option value="EFECTIVO">Efectivo</option>
                                                    <option value="CHEQUE">Cheque</option>
                                                    <option selected value="TRANSFERENCIA">Transferencia</option>
                                                    @endif

                                                </select>
                                                @error('forma_pago')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="forma_pago">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    <option value="EFECTIVO">Efectivo</option>
                                                    <option value="CHEQUE">Cheque</option>
                                                </select>
                                                @error('forma_pago')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <br>
                                                <label class="titulo">Banco <strong style="color:red">*</strong></label>
                                                @if(isset($persona))
                                                <select class="custom-select" name="clave_banco">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    @foreach ($bancos as $banco)
                                                    @if($persona->clave_banco==$banco->clave_banco)
                                                    <option selected value="{{$banco->clave_banco}}">
                                                        {{$banco->nombre_banco}}</option>
                                                    @else
                                                    <option value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('clave_banco')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @else
                                                <select class="custom-select" name="clave_banco">
                                                    <option selected disabled value="">Seleccione una opción:</option>
                                                    @foreach ($bancos as $banco)
                                                    <option value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('clave_banco')
                                                <div class="alert alert-secondary">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <br>
                                                <label class="titulo">Cuenta Bancaria</label>
                                                <input type="text" value="{{$persona->cuenta_bancaria ?? ''}}"
                                                    class="form-control" maxlength="20" name="cuenta_bancaria" value=""
                                                    onkeypress="return numeros(event)">
                                            
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <br>
                                                <label class="titulo">Clabe Interbancaria</label>
                                                <input type="text" value="{{$persona->clabe_interbancaria ?? ''}}"
                                                    class="form-control" maxlength="18" name="clabe_interbancaria"
                                                    value="" onkeypress="return numeros(event)">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <br>
                                                <br>
                                                @if(isset($persona))
                                                <div class="form-check">
                                                    @if($persona->ptu==0)
                                                    <input checked class="form-check-input" type="checkbox" name="ptu"
                                                        value="option1" aria-label="">
                                                    @else
                                                    <input class="form-check-input" type="checkbox" name="ptu"
                                                        value="option1" aria-label="">
                                                    @endif
                                                    <label class="titulo">Excluir para PTU</label>
                                                </div>
                                                @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ptu"
                                                        value="option1" aria-label="">
                                                    <label class="titulo">Excluir para PTU</label>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-10 mb-3">
                                                <label class="titulo">Observaciones</label>
                                                <input type="text" class="form-control" name="observaciones"
                                                    value="{{$persona->observaciones ?? ''}}" onkeyup="mayus(this);"
                                                    onkeypress="return validar(event)">
                                            </div>
                                        </div>
                                        <!--FIN Row contratación-->
                                    </div>
                                    <!--FIN ROW Contratación-->
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                @canany(['administrador','capturista','reportes'])
                                                <div class="col-md-5">
                                                    <div class="margin">
                                                        <div class="btn-group">
                                                            @if(isset($persona))
                                                            <div class="form-group">
                                                                <button title="Primero" type="submit" name="acciones" value="primero"
                                                                    id="primero" class="botonesgrandes"><i
                                                                        class="fas fa-backward"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Atrás" type="submit" name="acciones" value="atras"
                                                                    id="atras" class="botonesgrandes"><i
                                                                        class="fas fa-arrow-circle-left"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Siguiente" type="submit" name="acciones" value="siguiente"
                                                                    id="siguiente" class="botonesgrandes"><i
                                                                        class="fas fa-arrow-circle-right"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Último" type="submit" name="acciones" value="ultimo"
                                                                    id="ultimo" class="botonesgrandes"><i
                                                                        class="fas fa-forward"></i></button>
                                                            </div>
                                                            @else
                                                            <div class="form-group">
                                                                <button title="Primero" type="submit" class="botones" disabled><i
                                                                        class="fas fa-backward"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Atrás" type="submit" class="botones" disabled><i
                                                                        class="fas fa-arrow-circle-left"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Siguiente"  type="submit" class="botones" disabled><i
                                                                        class="fas fa-arrow-circle-right"></i></button>
                                                            </div>
                                                            <div class="form-group">
                                                                <button title="Último" type="submit" class="botones" disabled><i
                                                                        class="fas fa-forward"></i></button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endcanany
                                                <!--eSPACIO ENTRE BOTONES-->
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                @canany(['administrador','capturista','reportes'])
                                                @if(isset($persona))
                                                <div class="form-group">
                                                    <button title="Buscar" id="buscar" type="button" data-toggle="modal"
                                                        data-target="#modalbusquedaemp" class="botonesgrandes">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <button title="Buscar" id="buscar_falso" type="button" class="botonesgrandes"
                                                        disabled>
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                                @endif
                                                @endcanany
                                                @canany(['administrador','capturista'])
                                                <div class="form-group">
                                                    <button title="Agregar" type="button" id="nuevo" class="botonesgrandes"> <i
                                                            class="fas fa-user-plus"></i></button>
                                                </div>
                                                @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button title="Agregar" type="button" disabled class="botonesgrandes"> <i
                                                            class="fas fa-user-plus"></i></button>
                                                </div>
                                                @endcanany
                                                @canany(['administrador','capturista'])
                                                @if(isset($persona))
                                                <div class="form-group">
                                                    <button title="Actualizar" type="button" id="actualizar" class="botonesgrandes"> <i
                                                            class="fas fa-pen-square"></i></button>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <button title="Actualizar" type="button" disabled class="botonesgrandes"> <i
                                                            class="fas fa-pen-square"></i></button>
                                                </div>
                                                @endif
                                                @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button title="Actualizar" type="button" disabled class="botonesgrandes"> <i
                                                            class="fas fa-pen-square"></i></button>
                                                </div>
                                                @endcanany
                                                @can('administrador')
                                                <div class="form-group">
                                                    @if(isset($persona))
                                                    <a href="#" title="Eliminar" id="eliminar"
                                                        data-target="#modaldeleteempleado{{$persona->id_emp}}"
                                                        data-toggle="modal">
                                                        <button type="button" class="botonesgrandes">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                    @else
                                                    <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button title="Eliminar" type="button" disabled class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                                @elsecanany(['capturista','reportes'])
                                                <div class="form-group">
                                                    <a id="eliminar_">
                                                        <button title="Eliminar" type="button" disabled class="botonesgrandes">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                @endcan
                                                <!--eSPACIO ENTRE BOTONES-->
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <!--Su uso solo es para visualizar la existencia del los iconos -->
                                                
                                                <div class="form-group">
                                                    <button title="Guardar" id="guardar_falso" disabled class="botonesgrandes"><i
                                                            class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button title="Guardar" id="nuevo_reg" name="acciones" value="registrar"
                                                        type="submit" style="display: none;" class="botonesgrandes"><i
                                                            class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button title="Guardar" name="acciones" value="actualizar" id="actualizar_reg"
                                                        type="submit" style="display: none;" class="botonesgrandes"><i
                                                            class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button title="Cancelar" name="acciones" value="cancelar" id="cancelar_reg"
                                                        type="submit" disabled class="botonesgrandes"><i
                                                            class="far fa-window-close"></i></button>
                                                </div>
                                            
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <div class="form-group">
                                                    <button title="Subir Archivos" name="acciones" id="subir"
                                                        type="button" class="botonesgrandes"  data-toggle="modal" data-target="#subirArchivo">
                                                        <i class="far fa-copy"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!--Fin-->
                    </div>
                </div>
            </div>
            @include('emplea.modalbusqid')
            @include('emplea.subirArchivoEmpleado')
            @isset($persona)
            @include('emplea.modalelimina')
            @endisset
        </div>
    </div>
    @endsection