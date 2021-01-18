<div class="modal fade" id="modalmodificaempleado{{$persona->id_emp}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Empleados {{ $persona->clave_empleado }}  {{$persona->apellido_paterno }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-secondary card-tabs">
                <!--INICIO Cabeceras-->
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-one-personal-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-personal" aria-selected="true">Personal</a>

                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Personal 2</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Personal 3</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-tools-tab" data-toggle="pill" href="#custom-tabs-one-tools" role="tab" aria-controls="custom-tabs-one-tools" aria-selected="false">Contratación</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Referencias nuevas</a>
                    </li>
                  </ul>
                </div><!--Final Cabeceras-->
               
                <!--Inicio contenido-->
                <div class="card-body">
                  <!--General TABCONTENT-->
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <!--Inicio Personal-->
                     <div class="tab-pane fade show active" id="custom-tabs-one-personal" role="tabpanel" aria-labelledby="custom-tabs-one-personal-tab">
                      <form method="GET" action="{{route('empleados.index')}}"><!--Inicio FORM-->
                        <!--Personal 1-->
                        <div class="form-row">
                          <div class="col-md-1 mb-2">
                            <label for="validationDefault01">Clave</label>
                            <input type="text" class="form-control" name="clave_empleado" onkeypress="return numeros(event)" maxlength="4" 
                            value="{{ $persona->clave_empleado ?? ''}}">
                            <input type="hidden" class="form-control" name="id_emp" 
                            value="{{ $perona->id_emp ?? ''}}">
                          </div>
                          <div class="col-md-2">
                            <label for="validationDefault02">Clasificación</label>
                            <input  type="text" class="form-control" name="clasificacion" value="{{$persona->clasificacion ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Nombre</label>
                            <input  type="text" class="form-control" name="nombre"  onkeyup="mayus(this);" value="{{$persona->nombre ?? ''}}" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Apellido Paterno</label>
                            <input  type="text" class="form-control" name="apellido_paterno" onkeyup="mayus(this);" value="{{$persona->apellido_paterno ?? ''}}" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Apellido Materno</label>
                            <input  type="text" class="form-control" name="apellido_materno" onkeyup="mayus(this);" value="{{$persona->apellido_materno ?? ''}}" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Fecha de alta</label>
                            <input  type="date" value="{{$persona->fecha_alta ?? ''}}" class="form-control" name="fecha_alta">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Fecha de baja</label>
                            <input  type="date" class="form-control" value="{{$persona->fecha_baja ?? ''}}" name="fecha_baja">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault04">Causa de baja</label>
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
                                <option selected disabled value="">Seleccione una opción:</option>
                                <option>Renuncia</option>
                                <option>Despido</option>
                              </select>
                          @endif
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault04">Departamento</label>
                          @if(isset($persona))
                            <select class="custom-select" name="clave_departamento">
                              <option selected disabled value="">Seleccione una opción:</option>
                                @foreach ($departamentos as $depa)
                                  @if($persona->clave_departamento==$depa->clave_departamento)
                                    <option selected value="{{$depa->clave_departamento}}">{{$depa->departamento}}</option>
                                  @else
                                    <option value="{{$depa->clave_departamento}}">{{$depa->departamento}}</option>
                                  @endif
                                @endforeach
                            </select>
                          @else
                            <select class="custom-select" name="clave_departamento">
                                <option selected disabled value="">Seleccione una opción:</option>
                                  @foreach ($departamentos as $depa)
                                    <option value="{{$depa->clave_departamento}}">{{$depa->departamento}}</option>
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
                                    <option selected value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}</option>
                                  @else
                                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}</option>
                                
                                  @endif
                                  </select>
                                @endforeach   
                            @else
                              <select class="custom-select" name="clave_puesto">
                                <option selected disabled value="">Seleccione una opción:</option>
                                  @foreach ($puestos as $puest)
                                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}
                                    </option>
                                  @endforeach
                              </select>
                            @endif
                          </div>

                          
                          
                          <div class="col-md-2">
                            <label for="validationDefault03">RFC</label>
                            <input  type="text" class="form-control" value="{{$persona->rfc ?? ''}}" maxlength="13" name="rfc" onkeyup="mayus(this);"  pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$">
                          </div>

                          <div class="col-md-2">
                            <label for="validationDefault03">CURP</label>
                            <input  type="text" class="form-control" value="{{$persona->curp ?? ''}}" minlength="18" maxlength="18" name="curp" onkeyup="mayus(this);">
                          </div>

                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">IMSS</label>
                            <input  type="text" class="form-control" value="{{$persona->imss ?? ''}}" minlength="11" maxlength="11" name="imss" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Afore</label>
                            <input  type="text" class="form-control" value="{{$persona->afore ?? ''}}" name="afore">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">INE</label>
                            <input  type="text" class="form-control" value="{{$persona->ine ?? ''}}" maxlength="18" name="ine" onkeyup="mayus(this);">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Pasaporte</label>
                            <input type="text" class="form-control" value="{{$persona->pasaporte ?? ''}}" maxlength="6" name="pasaporte" onkeyup="mayus(this);">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Cartilla</label>
                            <input type="text" class="form-control" value="{{$persona->cartilla ?? ''}}" maxlength="10" name="cartilla" onkeyup="mayus(this);">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Licencia</label>
                            <input type="text" class="form-control" value="{{$persona->licencia ?? ''}}" maxlength="5" name="licencia" onkeyup="mayus(this);">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Documento migratorio</label>
                            <input type="text" class="form-control" value="{{$persona->documento_migratorio ?? ''}}" name="documento_migratorio"  maxlength="13" onkeyup="mayus(this);">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Calle</label>
                            <input  type="text" class="form-control" value="{{$persona->calle ?? ''}}" name="calle" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Número externo</label>
                            <input  type="text" class="form-control" value="{{$persona->numero_externo ?? ''}}" name="numero_externo" maxlength="4" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">Número interno</label>
                            <input type="text" class="form-control" value="{{$persona->numero_interno ?? ''}}" name="numero_interno" maxlength="4" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Colonia</label>
                            <input  type="text" class="form-control" value="{{$persona->colonia ?? ''}}" name="colonia" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <label for="validationDefault03">CP</label>
                            <input  type="text" class="form-control" value="{{$persona->cp ?? ''}}" name="cp" maxlength="6" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Ciudad</label>
                            <input  type="text" class="form-control" value="{{$persona->ciudad ?? ''}}" name="ciudad" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Municipio</label>
                            <input  type="text" class="form-control" value="{{$persona->municipio ?? ''}}" name="municipio" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Estado</label>
                            <input  type="text" class="form-control" value="{{$persona->estado ?? ''}}" name="estado" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Teléfono</label>
                            <input  type="text" class="form-control telefono_empleado" value="{{$persona->telefono_empleado ?? ''}}" name="telefono_empleado" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Correo</label>
                            <input  type="text" class="form-control" value="{{$persona->correo?? ''}}" name="correo">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Sexo</label>
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
                          @else
                             <select class="custom-select" name="sexo">
                                <option selected disabled value="">Seleccione una opción:</option>
                                <option value="HOMBRE">Hombre</option>
                                <option value="MUJER">Mujer</option>
                              </select>
                          @endif
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Estado Civil</label>
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
                          @else
                            <select class="custom-select" name="estado_civil">
                                <option selected disabled value="">Seleccione una opción:</option>
                                <option value="SOLTERO">Soltero</option>
                                <option value="CASADO">Casado</option>
                            </select>
                          @endif
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Nacionalidad</label>
                            <input  type="text" class="form-control" value="{{$persona->nacionalidad ?? ''}}" name="nacionalidad" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Tipo de sangre</label> 
                            <input  type="text" class="form-control" value="{{$persona->tipo_sangre ?? ''}}" name="tipo_sangre" onkeyup="mayus(this);" onkeypress="return validasangre(event)">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="validationDefault03">Alergias</label>
                            <input  type="text" class="form-control" value="{{$persona->alergias ?? ''}}" name="alergias" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                          <div class="col-md-1 mb-3">
                            <label for="validationDefault03">Estatura</label>
                            <input  type="number" class="form-control" value="{{$persona->estatura ?? ''}}" name="estatura" min="1.20" max="2.5" step="0.01">
                          </div>
                          <div class="col-md-1 mb-3">
                            <label for="validationDefault03">Peso</label>
                            <input  type="number" class="form-control" value="{{$persona->peso ?? ''}}" name="peso" min="30" max="200" step="0.01">

                          </div>
                        </div>
                    </div><!--Fin  Row Personal-->
                    <!--Inicio Personal 2-->
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                      <div class="form-row">
                        <div class="col-md-3 mb-2">
                          <label for="validationDefault01">Enfermedad Crónica</label>
                          <input  type="text" class="form-control" name="enfermedad_cronica" value="{{$persona->enfermedad_cronica ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3">
                          <label for="validationDefault02">Práctica de Deportes</label>
                          <input  type="text" class="form-control" name="deporte" value="{{$persona->deporte ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Pasatiempos</label>
                          <input  type="text" class="form-control" name="pasatiempo" value="{{$persona->deporte ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Asociación, Club Social o Deportivo</label>
                          <input  type="text" class="form-control" name="asosiacion" value="{{$persona->asosiacion ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Objetivo de Vida</label>
                          <input  type="text" class="form-control" name="objetivo_vida" value="{{$persona->objetivo_vida ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Nacimiento</label>
                          <input  type="date"  class="form-control" value="{{$persona->fecha_nacimiento ?? ''}}" name="fecha_nacimiento">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Lugar de Origen</label>
                          <input  type="text" class="form-control" name="lugar" value="{{$persona->lugar ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">UMF</label>
                          <input  type="text" class="form-control" name="umf" value="{{$persona->umf ?? ''}}" onkeypress="return numeros(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Nombre del Padre</label>
                          <input  type="text" class="form-control" name="nombre_padre" value="{{$persona->nombre_padre ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-1 mb-3">
                          <br>
                        @if(isset($persona))
                          <div class="form-check">
                            @if($persona->finado_padre==0)
                              <input checked class="form-check-input" type="checkbox" value="option1" name="finado_padre" aria-label="">
                            @else
                              <input class="form-check-input" type="checkbox" value="option1" name="finado_padre" aria-label="">
                            @endif
                            <label for="">Finado</label>
                          </div>
                        @else
                           <div class="form-check">
                              <input  class="form-check-input" type="checkbox" name="finado_padre" value="option1" aria-label="">
                              <label for="">Finado</label>
                            </div>
                        @endif

                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Direccion</label>
                          <input type="text" class="form-control" name="direccion_padre" value="{{$persona->direccion_padre ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Ocupación</label>
                          <input type="text" class="form-control" name="ocupacion_padre" value="{{$persona->ocupacion_padre ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Nombre de la Madre</label>
                          <input  type="text" class="form-control" value="{{$persona->nombre_madre ?? ''}}" name="nombre_madre" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-1 mb-3">
                          <br>
                        @if(isset($persona))
                          <div class="form-check">
                            @if($persona->finado_madre==0)
                              <input checked class="form-check-input" type="checkbox" name="finado_madre" value="option1" aria-label="">
                            @else
                              <input class="form-check-input" type="checkbox" name="finado_madre" value="option1" aria-label="">
                            @endif
                            <label for="">Finado</label>
                          </div>
                        @else
                          <div class="form-check">
                              <input  class="form-check-input" type="checkbox" name="finado_madre" value="option1" aria-label="">
                              <label for="">Finado</label>
                            </div>
                        @endif

                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Dirección</label>
                          <input type="text" class="form-control" name="direccion_madre" value="{{$persona->direccion_madre ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Ocupación</label>
                          <input type="text" class="form-control" name="ocupacion_madre" value="{{$persona->ocupacion_madre ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationDefault03">Nombre y edad de sus hijos</label>
                          <input type="text" class="form-control" name="hijos" value="{{$persona->hijos ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Idiomas</label>
                          <input  type="text" class="form-control" name="idiomas" value="{{$persona->idiomas ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Funciones de Oficina</label>
                          <input  type="text" class="form-control" name="funciones_oficina" value="{{$persona->funciones_oficina ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Máquinas de Oficina o Taller que Maneje</label>
                          <input  type="text" class="form-control" name="maquinas_oficina" value="{{$persona->maquinas_oficina ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Software que conoce</label>
                          <input  type="text" class="form-control" name="software" value="{{$persona->software ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Otras funciones o trabajos que domina</label>
                          <input  type="text" class="form-control" name="otras_funciones" value="{{$persona->otras_funciones ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                      </div><!--Fin  Row Personal 1-->
                    </div><!--Fin Personal 2-->
                    <!--Inicio Personal 3-->
                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                      <div class="form-row">
                        <div class="col-sm-12">
                          <label for="" style="text-align: left;">
                            <div class="col-md-12 mb-3">
                              <h4>
                                <strong>Beneficiarios</strong>
                              </h4>
                            </div>
                          </label>
                          <div class="col-md-11 mb-3" style="text-align: right;">
                            <h6 id="mensaje"></h6>
                          </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Nombre</label>
                          <input  type="text" class="form-control" name="beneficiario" value="{{$persona->beneficiario ?? ''}}" id="beneficiario" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="beneficiario1" value="{{$persona->beneficiario1 ?? ''}}" id="beneficiario1"  onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="beneficiario2" value="{{$persona->beneficiario2 ?? ''}}" id="beneficiario2" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="beneficiario3" value="{{$persona->beneficiario3 ?? ''}}" id="beneficiario3" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="beneficiario4" value="{{$persona->beneficiario4 ?? ''}}" id="beneficiario4" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationDefault03">Parentesco</label>
                          <input  type="text" class="form-control" name="parentesco" id="parentesco" value="{{$persona->parentesco ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="parentesco1" id="parentesco1" value="{{$persona->parentesco1 ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="parentesco2" id="parentesco2" value="{{$persona->parentesco2 ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="parentesco3" id="parentesco3" value="{{$persona->parentesco3 ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" class="form-control" name="parentesco4" id="parentesco4" value="{{$persona->parentesco4 ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">% de Participación</label>
                          <input  type="number" class="form-control" value="{{$persona->porcentaje ?? ''}}" name="porcentaje" min="0.1" max="100" step="0.01" id="porcentaje">
                          <input type="number" class="form-control" value="{{$persona->porcentaje1 ?? ''}}" name="porcentaje1" min="0.1" max="100" step="0.01" id="porcentaje1">
                          <input type="number" class="form-control" value="{{$persona->porcentaje2 ?? ''}}" name="porcentaje2" min="0.1" max="100" step="0.01" id="porcentaje2">
                          <input type="number" class="form-control" value="{{$persona->porcentaje3 ?? ''}}" name="porcentaje3" min="0.1" max="100" step="0.01" id="porcentaje3">
                          <input type="number" class="form-control" value="{{$persona->porcentaje4 ?? ''}}" name="porcentaje4" min="0.1" max="100" step="0.01" id="porcentaje4">
                        </div>
                        <div class="col-sm-12">
                          <label for="" style="text-align: left;">
                            <h4><strong>Estudios anteriores</strong></h4>
                          </label>
                        </div>
                        <!--Inicio titulos-->
                        <label for="" class="col-form-label col-sm-2">&nbsp &nbsp &nbsp </label>
                        <div class="col-sm-3">
                          <p>
                            <label for="pensamiento_id" style="text-align: justify;">Nombre de la Institución</label>
                          </p>
                        </div>
                        <div class="col-sm-4">
                          <p><label for="pensamiento_id" style="text-align: justify;">Inicio &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Finalizó</label></p>
                        </div>
                        <div class="col-sm-3">
                          <p><label for="pensamiento_id" style="text-align: justify;">Título obtenido</label></p>
                        </div>
                        <!--Fin titulos-->
                        <!--Inicio Primaria-->
                        <label for="" class="col-form-label col-sm-2">Primaria</label>
                        <div class="col-sm-3">
                          <input  type="text" value="{{$persona->primaria ?? ''}}" name="primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-4">
                          <input  value="{{$persona->duracion_primaria ?? ''}}" name="duracion_primaria" class="form-control" id="duracion5">
                        </div>
                        <div class="col-sm-3">
                          <input  type="text" value="{{$persona->titulo_primaria ?? ''}}" name="titulo_primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <!--FIN Primaria-->
                        <!--Inicio Secundaria-->
                        <label for="" class="col-form-label col-sm-2">Secundaria</label>
                        <div class="col-sm-3">
                          <input type="text" name="secundaria" value="{{$persona->secundaria ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-4">
                          <input name="duracion_secundaria" value="{{$persona->duracion_secundaria ?? ''}}" class="form-control" id="duracion6">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->titulo_secundaria ?? ''}}" name="titulo_secundaria ?? ''" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <!--FIN Secundaria-->
                        <!--Inicio Preparatoria-->
                        <label for="" class="col-form-label col-sm-2">Preparatoria</label>
                        <div class="col-sm-3">
                          <input type="text" name="preparatoria" value="{{$persona->preparatoria ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-4">
                          <input name="duracion_preparatoria" value="{{$persona->duracion_preparatoria ?? ''}}" class="form-control" id="duracion7">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="titulo_preparatoria" value="{{$persona->titulo_preparatoria ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <!--FIN Preparatoria-->
                        <!--Inicio Profesional-->
                        <label for="" class="col-form-label col-sm-2">Profesional</label>
                        <div class="col-sm-3">
                          <input type="text" name="profesional" value="{{$persona->profesional ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-4">
                          <input name="duracion_profesional" value="{{$persona->duracion_profesional ?? ''}}" class="form-control" id="duracion8">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="titulo_profesional" value="{{$persona->titulo_profesional ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <!--FIN Profesional-->
                        <!--Inicio Otras-->
                        <label for="" class="col-form-label col-sm-2">Otras</label>
                        <div class="col-sm-3">
                          <input type="text" name="otras" value="{{$persona->otras ?? '' }}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-4">
                          <input name="duracion_otras" value="{{$persona->duracion_otras ?? ''}}" class="form-control" id="duracion9">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="titulo_otras" value="{{$persona->titulo_otras ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <!--FIN Profesional-->
                        <div class="col-sm-12">
                          <label for="" style="text-align: left;">
                            <br><h4><strong>Estudios actuales</strong></h4>
                          </label>
                        </div>
                        <div class="col-md-5">
                          <label for="validationDefault03">Nombre de la Institución</label>
                          <input type="text" class="form-control" name="estudio_actual" value="{{$persona->estudio_actual ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">       
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Curso o Carrera</label>
                          <input type="text" class="form-control" name="carrera" value="{{$persona->carrera ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-1 mb-3">
                          <label for="validationDefault03">Grado</label>
                          <input type="number" class="form-control" name="grado" value="{{$persona->grado ?? ''}}" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault03">Horario</label>
                          <input type="text" class="form-control" value="{{$persona->horario ?? ''}}" name="horario">      
                        </div>
                      </div><!--Final Row Personal 2-->
                    </div><!--Final Personal 3-->
                    <!--Inicio Referencias-->
                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
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
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbspDe:&nbsp &nbsp &nbsp &nbsp&nbsp</label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A:  &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp &nbsp&nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp &nbsp&nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A: &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp De: &nbsp &nbsp &nbsp &nbsp&nbsp </label>
                          <label for="pensamiento_id" style="text-align: justify;">&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp A:  &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
                        </div>
                        <!--Inicio Vinculación Referencias-->
                        <div class="col-sm-3"> 
                          <input name="duracion_trabajo" value="{{$persona->duracion_trabajo ?? ''}}" class="form-control" id="duracion">
                        </div>
                        <div class="col-sm-3"> 
                          <input name="duracion_trabajo1" value="{{$persona->duracion_trabajo1 ?? ''}}"class="form-control" id="duracion2">
                        </div>
                        <div class="col-sm-3"> 
                          <input name="duracion_trabajo2" value="{{$persona->duracion_trabajo2 ?? ''}}"class="form-control" id="duracion3">
                        </div>
                        <div class="col-sm-3"> 
                          <input name="duracion_trabajo3" value="{{$persona->duracion_trabajo3 ?? ''}}"class="form-control" id="duracion4">
                        </div>
                        <label for="" class="col-form-label col-sm-12">Nombre de la Compañia</label>
                        <div class="col-sm-3">
                          <input type="text" name="nombre_compania" value="{{$persona->nombre_compania ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)" >
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="nombre_compania1" value="{{$persona->nombre_compania1 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="nombre_compania2" value="{{$persona->nombre_compania2 ?? ''}}"class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="nombre_compania3" value="{{$persona->nombre_compania3 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--Fin compañia Referencias-->
                        <!--Inicio Dirección Referencias-->
                        <label for="" class="col-form-label col-sm-12">Dirección</label>
                          <div class="col-sm-3">
                            <input type="text" name="direccion_compania" value="{{$persona->direccion_compania ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                        <div class="col-sm-3">
                            <input type="text" name="direccion1_trabajo1" value="{{$persona->direccion1_trabajo1 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="direccion_compania2"  value="{{$persona->direccion_compania2 ?? ''}}"class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="direccion3" value="{{$persona->direccion3 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--Fin Dirección Referencias-->
                        <!--Inicio Telefono Referencias-->
                        <label for="" class="col-form-label col-sm-12">Télefono</label>
                        <div class="col-sm-3">
                          <input type="text" name="telefono_compania" value="{{$persona->telefono_compania ?? ''}}" class="form-control telefono_compania" tabindex="1">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="telefono1" value="{{$persona->telefono1 ?? ''}}" class="form-control telefono1">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="telefono2" value="{{$persona->telefono2 ?? ''}}" class="form-control telefono2">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="telefono3" value="{{$persona->telefono3 ?? ''}}" class="form-control telefono3">
                        </div><!--FIN Telefono Referencias-->
                        <!--INCIO sueldo Referencias-->
                        <label for="" class="col-form-label col-sm-12">Sueldo</label>
                        <div class="col-sm-3">
                          <input type="number" value="{{$persona->sueldo ?? ''}}" step="0.01" min="0.00" max="100000.0" name="sueldo" class="form-control" onkeypress="return numeros(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" value="{{$persona->sueldo1 ?? ''}}" step="0.01" min="0.00" max="100000.0" name="sueldo1" class="form-control" onkeypress="return numeros(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" value="{{$persona->sueldo2 ?? ''}}" step="0.01" min="0.00" max="100000.0" name="sueldo2" class="form-control" onkeypress="return numeros(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" value="{{$persona->sueldo3 ?? ''}}" step="0.01" min="0.00" max="100000.0" name="sueldo3" class="form-control" onkeypress="return numeros(event)">
                        </div><!--FIN sueldo Referencias-->
                        <!--INCIO Motivo separación Referencias-->
                        <label for="" class="col-form-label col-sm-12">Motivo de la Separación</label>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->motivo_separacion ?? ''}}" name="motivo_separacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->motivo_separacion1 ?? ''}}" name="motivo_separacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->motivo_separacion2 ?? ''}}"name="motivo_separacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->motivo_separacion3 ?? ''}}"name="motivo_separacion3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--FIN Motivo separación Referencias-->
                        <!--INCIO Jefe Directo separación Referencias-->
                        <label for="" class="col-form-label col-sm-12">Nombre del Jefe Directo</label>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->nombre_jefe ?? ''}}" name="nombre_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->nombre_jefe1 ?? ''}}" name="nombre_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->nombre_jefe2 ?? ''}}" name="nombre_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->nombre_jefe3 ?? ''}}" name="nombre_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--FIN Jefe Directo separación Referencias-->
                        <!--INCIO Puesto Jefe Directo separación Referencias-->
                        <label for="" class="col-form-label col-sm-12">Puesto del Jefe Inmediato</label>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->puesto_jefe ?? ''}}" name="puesto_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->puesto_jefe1 ?? ''}}" name="puesto_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->puesto_jefe2 ?? '' }}" name="puesto_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->puesto_jefe3 ?? ''}}" name="puesto_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--FIN Puesto Jefe Directo separación Referencias-->
                        <!--INCIO Informes separación Referencias-->
                        <label for="" class="col-form-label col-sm-12">Podemos Solicitar Informes:</label>
                        <div class="col-sm-3">
                        @if(isset($persona))
                            @if($persona->solicitar_informes==0)
                              <input checked type="checkbox" name="solicitar_informes" class="form-control">
                            @else
                              <input type="checkbox" name="solicitar_informes" class="form-control">
                            @endif
                        @else
                          <input type="checkbox" name="solicitar_informes" class="form-control">
                        @endif
                        </div>

                        <div class="col-sm-3">
                        @if(isset($persona))
                            @if($persona->solicitar_informes1==0)
                              <input checked type="checkbox" name="solicitar_informes1" class="form-control">
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
                              <input checked type="checkbox" name="solicitar_informes2" class="form-control">
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
                              <input checked type="checkbox" name="solicitar_informes3" class="form-control">
                            @else
                              <input type="checkbox" name="solicitar_informes3" class="form-control">
                            @endif
                        @else
                           <input type="checkbox" name="solicitar_informes3" class="form-control">
                        @endif
                        </div><!--FIN Informes separación Referencias-->
                        

                        <!--Razones Informes separación Referencias-->
                        <label for="" class="col-form-label col-sm-12">Razones</label>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->razones ?? ''}}" name="razones" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->razones1 ?? ''}}" name="razones1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" value="{{$persona->razones2 ?? ''}}" name="razones2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                        <div class="col-sm-3">
                          <input type="text" value="{{$persona->razones3 ?? ''}}" name="razones3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div><!--FIN Razones Informes separación Referencias-->
                        <div class="col-sm-12">
                          <p><label for="" style="text-align: left;">
                            <h4><strong>Referencias Personales</strong></h4>
                          </label></p>
                        </div>
                        <div class="col-sm-3">
                          <label for="" style="text-align: left;">Nombre</label>
                          <input  type="text" name="referencia" value="{{$persona->referencia ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" value="{{$persona->referencia1 ?? ''}}" name="referencia1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" value="{{$persona->referencia2 ?? ''}}" name="referencia2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-2">
                          <label for="" style="text-align: left;">Dirección</label>
                          <input  type="text" name="direccion_trabajo" value="{{$persona->direccion_trabajo ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" name="direccion1" value="{{$persona->direccion1 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" name="direccion2" value="{{$persona->direccion2 ?? ''}}" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-2">
                          <label for="" style="text-align: left;">Teléfono</label>
                          <input  type="text" value="{{$persona->telefono_referencia ?? ''}}" name="telefono_referencia" class="form-control telefono_referencia">
                          <input type="text" value="{{$persona->telefono_referencia1 ?? ''}}" name="telefono_referencia1" class="form-control telefono_referencia1">
                          <input type="text" value="{{$persona->telefono_referencia2 ?? ''}}" name="telefono_referencia2" class="form-control telefono_referencia2">
                        </div>
                        <div class="col-sm-3">
                          <label for="" style="text-align: left;">Ocupación</label>
                          <input  type="text" value="{{$persona->ocupacion ?? ''}}" name="ocupacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" value="{{$persona->ocupacion1 ?? ''}}" name="ocupacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          <input type="text" value="{{$persona->ocupacion2 ?? ''}}" name="ocupacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                        <div class="col-sm-1">
                          <label for="" style="text-align: left;">Tiempo</label>
                          <input  type="number" value="{{$persona->tiempo ?? ''}}" name="tiempo" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                          <input type="number" value="{{$persona->tiempo1 ?? ''}}" name="tiempo1" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                          <input type="number" value="{{$persona->tiempo2 ?? ''}}" name="tiempo2" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                        </div>
                      </div><!--Final Row Referencias-->
                    </div>
                    <!--Inicio Contratación-->
                    <div class="tab-pane fade" id="custom-tabs-one-tools" role="tabpanel" aria-labelledby="custom-tabs-one-tools-tab">
                      <!--Inicio Row contratación-->
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault04">Tipo de trabajador</label>
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
                        @else
                          <select class="custom-select" name="tipo_trabajador">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="EMPLEADO">Administrativo</option>
                              <option value="PATRON">Sindicalizado</option>
                            </select>
                        @endif
                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="validationDefault04">Turno</label>
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
                              @elseif($persona->turno=="")
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
                          @else
                            <select class="custom-select" name="turno">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="DIURNO">Diurno</option>
                              <option value="NOCTURNO">Nocturno</option>
                              <option value="MIXTO">Mixto</option>
                            </select>
                          @endif

                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationDefault04">Contrato</label>
                        @if(isset($persona))
                            <select class="custom-select" name="contrato">
                              @if($persona->contrato=="")
                                <option selected disabled value="">Seleccione una opción:</option>
                                <option value="PRUEBA">Prueba</option>
                                <option value="DETERMINDO">Tiempo determinado</option>
                                <option value="INDETERMINADO">Tiempo indeterminado</option>
                              @elseif($persona->contrato=="PRUEBA")
                                <option disabled value="">Seleccione una opción:</option>
                                <option selected value="PRUEBA">Prueba</option>
                                <option value="DETERMINDO">Tiempo determinado</option>
                                <option value="INDETERMINADO">Tiempo indeterminado</option>
                              @elseif($persona->contrato=="DETERMINADO")
                                <option disabled value="">Seleccione una opción:</option>
                                <option value="PRUEBA">Prueba</option>
                                <option selected value="DETERMINDO">Tiempo determinado</option>
                                <option value="INDETERMINADO">Tiempo indeterminado</option>
                              @elseif($persona->contrato=="INDETERMINADO")
                                <option disabled value="">Seleccione una opción:</option>
                                <option value="PRUEBA">Prueba</option>
                                <option value="DETERMINDO">Tiempo determinado</option>
                                <option selected value="INDETERMINADO">Tiempo indeterminado</option>
                              @endif
                            </select>
                        @else
                          <select class="custom-select" name="contrato">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="PRUEBA">Prueba</option>
                              <option value="DETERMINDO">Tiempo determinado</option>
                              <option value="INDETERMINADO">Tiempo indeterminado</option>
                            </select>
                        @endif
                        </div>

                        <div class="col-md-3 mb-2">
                          <label for="validationDefault01">Vigencia</label>
                          <input  type="date" class="form-control" name="vigencia" value="{{$persona->vigencia ?? ''}}">
                        </div>
                        <div class="col-md-2 mb-2">
                            <br>
                            <label for="validationDefault01">Horario inicio</label>
                            <input  type="time" class="form-control" name="horario_trabajoinicio" value="{{$persona->horario_trabajoinicio ?? ''}}">
                          </div>
                          <div class="col-md-2 mb-2">
                            <br>
                            <label for="validationDefault01">Horario fin</label>
                            <input  type="time" class="form-control" name="horario_trabajofin" value="{{$persona->horario_trabajofin ?? ''}}">
                          </div>
                          <div class="col-md-2 mb-2">
                            <br>
                            <label for="validationDefault01">Sueldo diario</label>
                            <input  type="number" class="form-control" name="sueldo_diario" value="{{$persona->sueldo_diario ?? ''}}" maxlength="5" min="0.01" max="10000.00" step="0.01" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-2 mb-2">
                            <br>
                            <label for="validationDefault01">Sueldo diario integrado</label>
                            <input  type="number" class="form-control" name="sueldo_integrado" value="{{$persona->sueldo_integrado ?? ''}}" maxlength="5" min="0.01" max="10000.00" step="0.01" onkeypress="return numeros(event)" readonly>
                          </div>
                          <div class="col-md-2 mb-2">
                            <label for="validationDefault01">Tabulación<br>Nivel</label>
                            <input type="text" onkeyup="mayus(this);" class="form-control" name="nivel" value="{{$persona->nivel ?? ''}}">
                          </div>
                          <div class="col-md-2 mb-2">
                            <br>
                            <label for="validationDefault01">Categoria</label>
                            <input type="text" onkeyup="mayus(this);" class="form-control" name="categoria" value="{{$persona->categoria ?? ''}}">
                          </div>
                          <div class="col-md-2 mb-3">
                            <br>
                            <label for="validationDefault04">Tipo salario</label>
                            
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
                          @else
                            <select class="custom-select" name="tipo_salario">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="FIJO">Fijo</option>
                              <option value="VARIABLE">Variable</option>
                            </select>
                          @endif
                          </div>
                          <div class="col-md-2 mb-3">
                            <br>
                            <label for="validationDefault04">Tipo de jornada</label>
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
                          @else
                            <select class="custom-select" name="tipo_jornada">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="COMPLETA">Completa</option>
                              <option value="REDUCIDA">Reducida</option>
                            </select>
                          @endif
                          </div>

                          <div class="col-md-1 mb-3">
                            <label for="validationDefault04">Jornada <br> Días</label>
                            <input  type="number" value="{{$persona->dias ?? ''}}" class="form-control" name="dias" min="1" max="7" step="1" >
                          </div>
                          <div class="col-md-1 mb-3">
                            <br>
                            <label for="validationDefault04">Horas</label>
                            <input  type="number" value="{{$persona->horas_diarias ?? ''}}" class="form-control" name="horas_diarias" min="1" max="24" step="any" value="">
                          </div>
                          <div class="col-md-2 mb-3"> 
                            <br>
                            <label for="validationDefault04">Forma de Pago</label>
                            @if(isset($persona))
                              <select class="custom-select" name="forma_pago">
                                @if($persona->forma_pago=="")
                                <option selected disabled value="">Seleccione una opción:</option>
                                <option value="EFECTIVO">Efectivo</option>
                                <option value="CHEQUE">Cheque</option>
                              @elseif($persona->forma_pago=="EFECTIVO")
                                <option disabled value="">Seleccione una opción:</option>
                                <option selected value="EFECTIVO">Efectivo</option>
                                <option value="CHEQUE">Cheque</option>
                              @elseif($persona->forma_pago=="CHEQUE")
                                <option disabled value="">Seleccione una opción:</option>
                                <option value="EFECTIVO">Efectivo</option>
                                <option selected value="CHEQUE">Cheque</option>
                              
                              @endif
                              </select>
                            @else
                            <select class="custom-select" name="forma_pago">
                              <option selected disabled value="">Seleccione una opción:</option>
                              <option value="EFECTIVO">Efectivo</option>
                              <option value="CHEQUE">Cheque</option>
                            </select>
                            @endif
                          </div>

                          <div class="col-md-2 mb-3">
                            <br>
                            <label for="validationDefault04">Banco</label>
                          @if(isset($persona))
                              <select class="custom-select" name="clave_banco">
                                <option selected disabled value="">Seleccione una opción:</option>
                                  @foreach ($bancos as $banco)
                                    @if($persona->clave_banco==$banco->clave_banco)
                                      <option selected value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}</option>
                                     @else
                                      <option value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}</option>
                                    @endif
                                  @endforeach
                              </select>
                          @else 
                            <select class="custom-select" name="clave_banco">
                              <option selected disabled value="">Seleccione una opción:</option>
                                @foreach ($bancos as $banco)
                                  <option value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}</option>
                                @endforeach
                            </select>
                          @endif
                          </div>
                          <div class="col-md-4 mb-4">
                            <br>
                            <label for="validationDefault04">Cuenta Bancaria</label>
                            <input  type="text" value="{{$persona->cuenta_bancaria ?? ''}}" class="form-control" maxlength="20" name="cuenta_bancaria" value="" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-4 mb-4">
                            <br>
                            <label for="validationDefault04">Clabe Interbancaria</label>
                            <input  type="text" value="{{$persona->clabe_interbancaria ?? ''}}" class="form-control" maxlength="18" name="clabe_interbancaria" value="" onkeypress="return numeros(event)">
                          </div>
                          <div class="col-md-2 mb-3">
                            <br><br>
                            @if(isset($persona))
                              <div class="form-check">
                                @if($persona->ptu==0)
                                  <input checked class="form-check-input" type="checkbox" name="ptu" value="option1" aria-label="">
                                @else
                                  <input class="form-check-input" type="checkbox" name="ptu" value="option1" aria-label="">
                                @endif
                                <label for="">Excluir para PTU</label>
                              </div>
                            @else
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="ptu" value="option1" aria-label="">
                              <label for="">Excluir para PTU</label>
                              </div>
                            @endif

                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="validationDefault04">Observaciones</label>
                            <input type="text" class="form-control" name="observaciones" value="{{$persona->observaciones ?? ''}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                          </div>
                        </div><!--FIN Row contratación-->
                      </div><!--FIN ROW Contratación-->
                    </div>
              
                 
                 
                    

                      <div class="col-sm-6">
                        <div class="card-body">
                          <div class="margin">
                            <div class="btn-group">
                              <div class="form-group">
                                  <button type="button" id="nuevo" style='width:70px; height:40px'><i class="fas fa-user-plus"></i></button>
                              </div>
                              <!--
                              <div class="form-group">
                                <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                              </div>-->
                              
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-sm-2">
                        <div class="card-body">
                          <div class="margin">
                            <div class="btn-group">
                              <div class="form-group">
                                <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                              </div>
                              <div class="form-group">
                                  <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div><!--Final CARD principal-->
              </div><!--Final Col principal-->
            </div><!--Final row principal-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>