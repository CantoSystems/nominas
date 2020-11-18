<div class="modal fade" id="modalcrudempleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Empleados</h5>
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
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Personal</a>
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
              <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Referencias</a>
            </li>
            
          </ul>
        </div><!--Final Cabeceras-->
        <!--Inicio contenido-->
        <div class="card-body">
          <!--General TABCONTENT-->
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <!--Inicio Personal-->
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            <form method="GET" action="{{route('empleados.index')}}"><!--Inicio FORM-->
                <div class="form-row">
                  <div class="col-md-1 mb-2">
                    <label for="validationDefault01">Clave</label>
                    <input type="text" class="form-control" name="clave_empleado" value="" onkeypress="return numeros(event)" readonly>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault02">Clasificación</label>
                    <input required type="text" class="form-control" name="clasificacion" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Nombre</label>
                    <input required type="text" class="form-control" name="nombre"  onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Paterno</label>
                    <input required type="text" class="form-control" name="apellido_paterno" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Materno</label>
                    <input required type="text" class="form-control" name="apellido_materno" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de alta</label>
                    <input required type="date" class="form-control" name="fecha_alta">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de baja</label>
                    <input  type="date" class="form-control" name="fecha_baja">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Causa de baja</label>
                    <select class="custom-select" name="causa_baja">
                      <option selected  value=""></option>
                      <option>Renuncia</option>
                      <option>Despido</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Departamento</label>
                    <select class="custom-select" name="clave_departamento">
                      <option selected disabled value="">Seleccione una opción:</option>
                      @foreach ($departamentos as $depa)
                    <option value="{{$depa->clave_departamento}}">{{$depa->departamento}}</option>    
                      @endforeach
                      
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Puesto</label>
                    <select class="custom-select" name="clave_puesto">
                      <option selected disabled value="">Seleccione una opción:</option>
                      @foreach ($puestos as $puest)
                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}</option>    
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">RFC</label>
                    <input required type="text" class="form-control" maxlength="13" name="rfc" onkeyup="mayus(this);"  pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A-ZÑ\x26]|[0-9]){1})?$" >
                  </div>
                   <div class="col-md-2">
                    <label for="validationDefault03">CURP</label>
                    <input required type="text" class="form-control" minlength="18" maxlength="18" name="curp" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">IMSS</label>
                    <input required type="text" class="form-control" minlength="11" maxlength="11" name="imss" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Afore</label>
                    <input required type="text" class="form-control" name="afore">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">INE</label>
                    <input required type="text" class="form-control" maxlength="18" name="ine" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Pasaporte</label>
                    <input required type="text" class="form-control" maxlength="6" name="pasaporte" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Cartilla</label>
                    <input required type="text" class="form-control" maxlength="10" name="cartilla" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Licencia</label>
                    <input required type="text" class="form-control" maxlength="5" name="licencia" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Documento migratorio</label>
                    <input required type="text" class="form-control" name="documento_migratorio"  maxlength="13" onkeyup="mayus(this);">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Calle</label>
                    <input required type="text" class="form-control" name="calle" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Número externo</label>
                    <input required type="text" class="form-control" name="numero_externo" maxlength="4" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Número interno</label>
                    <input required type="text" class="form-control" name="numero_interno" maxlength="4" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Colonia</label>
                    <input required type="text" class="form-control" name="colonia" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">CP</label>
                    <input required type="text" class="form-control" name="cp" maxlength="6" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Ciudad</label>
                    <input required type="text" class="form-control" name="ciudad" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Municipio</label>
                    <input required type="text" class="form-control" name="municipio" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado</label>
                    <input required type="text" class="form-control" name="estado" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Teléfono</label>
                    <input required type="text" class="form-control telefono_empleado" name="telefono_empleado" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Correo</label>
                    <input required type="text" class="form-control" name="correo">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Sexo</label>
                    <select class="custom-select" name="sexo">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="HOMBRE">Hombre</option>
                      <option value="MUJER">Mujer</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Estado Civil</label>
                    <select class="custom-select" name="estado_civil">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="SOLTERO">Soltero</option>
                      <option value="CASADO">Casado</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Nacionalidad</label>
                    <input required type="text" class="form-control" name="nacionalidad" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Tipo de sangre</label>
                    <input required type="text" class="form-control" name="tipo_sangre" onkeyup="mayus(this);" onkeypress="return validasangre(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Alergias</label>
                    <input required type="text" class="form-control" name="alergias" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Estatura</label>
                    <input required type="number" class="form-control"  name="estatura" min="1.20" max="2.5" step="0.01">
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Peso</label>
                    <input required type="number" class="form-control" name="peso" min="30" max="200" step="0.01">
                  </div>
                </div><!--Fin  Row Personal-->
            </div><!--Fin  Personal-->
            <!--Inicio Personal 1-->
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
              <div class="form-row"><!--Inicio Row Personal 1-->
                <div class="col-md-3 mb-2">
                <label for="validationDefault01">Enfermedad Crónica</label>
                <input required type="text" class="form-control" name="enfermedad_cronica" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3">
                <label for="validationDefault02">Práctica de Deportes</label>
                <input required type="text" class="form-control" name="deporte" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Pasatiempos</label>
                <input required type="text" class="form-control" name="pasatiempo" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Asociación, Club Social o Deportivo</label>
                <input required type="text" class="form-control" name="asosiacion" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Objetivo de Vida</label>
                <input required type="text" class="form-control" name="objetivo_vida" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nacimiento</label>
                <input required type="date" max="{{$fechalimite}}-12-31" class="form-control" name="fecha_nacimiento">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Lugar de Origen</label>
                <input required type="text" class="form-control" name="lugar" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">UMF</label>
                <input required type="text" class="form-control" name="umf" onkeypress="return numeros(event)">
              </div>
               <div class="col-md-4 mb-3">
                <label for="validationDefault03">Nombre del Padre</label>
                <input required type="text" class="form-control" name="nombre_padre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>

              <div class="col-md-1 mb-3">
                <br>
                <div class="form-check">
                <input  class="form-check-input" type="checkbox" name="finado_padre" value="option1" aria-label="">
                <label for="">Finado</label>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Direccion</label>
                <input required type="text" class="form-control" name="direccion_padre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupación</label>
                <input required type="text" class="form-control" name="ocupacion_padre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Nombre de la Madre</label>
                <input required type="text" class="form-control" name="nombre_madre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-1 mb-3">
                <br>
                <div class="form-check">
                <input  class="form-check-input" type="checkbox" name="finado_madre" value="option1" aria-label="">
                <label for="">Finado</label>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Dirección</label>
                <input required type="text" class="form-control" name="direccion_madre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupación</label>
                <input required type="text" class="form-control" name="ocupacion_madre" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault03">Nombre y edad de sus hijos</label>
                <input required type="text" class="form-control" name="hijos" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Idiomas</label>
                <input required type="text" class="form-control" name="idiomas" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Funciones de Oficina</label>
                <input required type="text" class="form-control" name="funciones_oficina" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Máquinas de Oficina o Taller que Maneje</label>
                <input required type="text" class="form-control" name="maquinas_oficina" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Software que conoce</label>
                <input required type="text" class="form-control" name="software" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Otras funciones o trabajos que domina</label>
                <input required type="text" class="form-control" name="otras_funciones" onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              </div><!--Fin  Row Personal 1-->
            </div><!--Fin Personal 1-->
            <!--Inicio Personal 2-->
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
              <!--Inicio  Row Personal 2-->
              <div class="form-row">
                <div class="col-sm-12">
                    <label for="" style="text-align: left;">
                      <h4><strong>Beneficiarios</strong></h4>
                      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <h5 id="mensaje"></h5>
                      
                    </label> 
                </div>
                 <div class="col-md-4 mb-3">
                  <label for="validationDefault03">Nombre</label>
                    <input required type="text" class="form-control" name="beneficiario" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="beneficiario1" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="beneficiario2" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="beneficiario3" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="beneficiario4" onkeyup="mayus(this);" onkeypress="return validar(event)"> 
                 </div>
                 <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Parentesco</label>
                    <input required type="text" class="form-control" name="parentesco" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="parentesco1" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="parentesco2" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="parentesco3" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" class="form-control" name="parentesco4" onkeyup="mayus(this);" onkeypress="return validar(event)"> 
                 </div>

                 <div class="col-md-3 mb-3">
<<<<<<< HEAD
                  <label for="validationDefault03">% de Participación</label>
                  <input required type="number" class="form-control" name="porcentaje"  min="0.1" max="99.6" step="0.01">
                  <input required type="number" class="form-control" name="porcentaje1" min="0.1" max="99.6" step="0.01">
                  <input required type="number" class="form-control" name="porcentaje2" min="0.1" max="99.6" step="0.01">
                  <input required type="number" class="form-control" name="porcentaje3" min="0.1" max="99.6" step="0.01">
                  <input required type="number" class="form-control" name="porcentaje4" min="0.1" max="99.6" step="0.01">
=======
                  <label for="validationDefault03">% de Participacion</label>
                  <input required type="number" class="form-control" name="porcentaje"  min="0.1" max="99.6" step="0.01" id="porcentaje">
                  <input required type="number" class="form-control" name="porcentaje1" min="0.1" max="99.6" step="0.01" id="porcentaje1">
                  <input required type="number" class="form-control" name="porcentaje2" min="0.1" max="99.6" step="0.01" id="porcentaje2">
                  <input required type="number" class="form-control" name="porcentaje3" min="0.1" max="99.6" step="0.01" id="porcentaje3">
                  <input required type="number" class="form-control" name="porcentaje4" min="0.1" max="99.6" step="0.01" id="porcentaje4">
>>>>>>> 28985642f91373ffa0bb6b02f4dda27e1babf54e
                 </div>
                 <div class="col-sm-12">
                    <label for="" style="text-align: left;">
                      <h4><strong>Estudios anteriores</strong></h4>
                    </label> 
                </div>
               <!--Inicio titulos-->
                 <label for="" class="col-form-label col-sm-2">&nbsp &nbsp &nbsp </label>
                   <div class="col-sm-3">
                    <p><label for="pensamiento_id" style="text-align: justify;">
                      Nombre de la Institución
                    </label></p>
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
                  <input required type="text" name="primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input required name="duracion_primaria" class="form-control" id="duracion5">
                </div>
              
                <div class="col-sm-3">
                  <input required type="text" name="titulo_primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Primaria-->
               <!--Inicio Secundaria-->
                <label for="" class="col-form-label col-sm-2">Secundaria</label>
                <div class="col-sm-3">
                  <input required type="text" name="secundaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input required name="duracion_secundaria" class="form-control" id="duracion6">
                </div>
               
                <div class="col-sm-3">
                  <input required type="text" name="titulo_secundaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Secundaria-->
              <!--Inicio Preparatoria-->
                <label for="" class="col-form-label col-sm-2">Preparatoria</label>
                <div class="col-sm-3">
                  <input required type="text" name="preparatoria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input required  name="duracion_preparatoria" class="form-control" id="duracion7">
                </div>
               
                <div class="col-sm-3">
                  <input required type="text" name="titulo_preparatoria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Preparatoria-->
              <!--Inicio Profesional-->
                <label for="" class="col-form-label col-sm-2">Profesional</label>
                <div class="col-sm-3">
                  <input required type="text" name="profesional" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input required name="duracion_profesional" class="form-control" id="duracion8">
                </div>
                
                <div class="col-sm-3">
                  <input required type="text" name="titulo_profesional" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Profesional-->
               
               <!--Inicio Otras-->
                <label for="" class="col-form-label col-sm-2">Otras</label>
                <div class="col-sm-3">
                  <input required type="text" name="otras" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input required  name="duracion_otras" class="form-control" id="duracion9">
                </div>
             
                <div class="col-sm-3">
                  <input required type="text" name="titulo_otras" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Profesional-->
              <div class="col-sm-12">
                    <label for="" style="text-align: left;">
                      <br><h4><strong>Estudios actuales</strong></h4>
                    </label> 
                </div>
               <div class="col-md-5">
                <label for="validationDefault03">Nombre de la Institución</label>
                <input required type="text" class="form-control" name="estudio_actual" onkeyup="mayus(this);" onkeypress="return validar(event)">       
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Curso o Carrera</label>
                <input required type="text" class="form-control" name="carrera" onkeyup="mayus(this);" onkeypress="return validar(event)">
                
               </div>
               <div class="col-md-1 mb-3">
                <label for="validationDefault03">Grado</label>
                <input required type="number" class="form-control" name="grado" min="1" max="10">
                
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Horario</label>
                <input required type="text" class="form-control" name="horario">      
               </div>
              </div><!--Final Row Personal 2-->
            </div><!--Final Personal 2-->
            <!--INICIO referencias-->
            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
              <!--Inicio Row Referencias-->
              <div class="form-group row">
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
                      <input required  name="duracion_trabajo" class="form-control" id="duracion">
                   </div>
                   <div class="col-sm-3"> 
                      <input required  name="duracion_trabajo1" class="form-control" id="duracion2">
                   </div>
                   <div class="col-sm-3"> 
                      <input required name="duracion_trabajo2" class="form-control" id="duracion3">
                   </div>
                   <div class="col-sm-3"> 
                      <input required name="duracion_trabajo3" class="form-control" id="duracion4">
                   </div>

                    <label for="" class="col-form-label col-sm-12">Nombre de la Compañia
                    </label>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_compania" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)" >
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_compania1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_compania2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_compania3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--Fin compañia Referencias-->
                    <!--Inicio Dirección Referencias-->
                    <label for="" class="col-form-label col-sm-12">Dirección</label>
                      <div class="col-sm-3">
                        <input required type="text" name="direccion_compania" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                    <div class="col-sm-3">
                        <input required type="text" name="direccion1_trabajo1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="direccion_compania2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="direccion3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--Fin Dirección Referencias-->
                    <!--Inicio Telefono Referencias-->
                    <label for="" class="col-form-label col-sm-12">Télefono</label>
                    <div class="col-sm-3">
                      <input required type="text" name="telefono_compania" class="form-control telefono_compania" placeholder="" tabindex="1">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="telefono1" class="form-control telefono1">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="telefono2" class="form-control telefono2">
                    </div>
                    <div class="col-sm-3">
                    <input required type="text" name="telefono3" class="form-control telefono3">
                    </div><!--FIN Telefono Referencias-->
                    <!--INCIO sueldo Referencias-->
                    <label for="" class="col-form-label col-sm-12">Sueldo</label>
                    <div class="col-sm-3">
                      <input required type="number" step="0.01" min="0.00" max="100000.0" name="sueldo" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="number" step="0.01" min="0.00" max="100000.0" name="sueldo1" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="number" step="0.01" min="0.00" max="100000.0" name="sueldo2" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="number" step="0.01" min="0.00" max="100000.0" name="sueldo3" class="form-control" onkeypress="return numeros(event)">
                    </div><!--FIN sueldo Referencias-->
                    <!--INCIO Motivo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Motivo de la Separación</label>
                    <div class="col-sm-3">
                      <input required type="text" name="motivo_separacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="motivo_separacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="motivo_separacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="motivo_separacion3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--FIN Motivo separación Referencias-->
                    <!--INCIO Jefe Directo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Nombre del Jefe Directo</label>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="nombre_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--FIN Jefe Directo separación Referencias-->
                    <!--INCIO Puesto Jefe Directo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Puesto del Jefe Inmediato</label>
                    <div class="col-sm-3">
                      <input required type="text" name="puesto_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="puesto_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="puesto_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input required type="text" name="puesto_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--FIN Puesto Jefe Directo separación Referencias-->
                    <!--INCIO Informes separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Podemos Solicitar Informes:</label>
                    <div class="col-sm-3">
                      <input type="checkbox" name="solicitar_informes" class="form-control">
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" name="solicitar_informes1" class="form-control">
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" name="solicitar_informes2" class="form-control">
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" name="solicitar_informes3" class="form-control">
                    </div><!--FIN Informes separación Referencias-->
                    <!--Razones Informes separación Referencias-->
                     <label for="" class="col-form-label col-sm-12">Razones</label>
                      <div class="col-sm-3">
                        <input required required type="text" name="razones" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                      <div class="col-sm-3">
                        <input required type="text" name="razones1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                      <div class="col-sm-3">
                      <input required type="text" name="razones2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                      <div class="col-sm-3">
                        <input required type="text" name="razones3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div><!--FIN Razones Informes separación Referencias-->
                      <div class="col-sm-12">
                        <p><label for="" style="text-align: left;">
                          <h4><strong>Referencias</strong></h4>
                        </label></p>
                      </div>
                    <div class="col-sm-3">
                      <label for="" style="text-align: left;"> Nombre
                      </label>
                      <input required type="text" name="referencia" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input required type="text" name="referencia1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input required type="text" name="referencia2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-2">
                      <label for="" style="text-align: left;">Dirección 
                    </label>
                      <input required type="text" name="direccion_trabajo" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input required type="text" name="direccion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input required type="text" name="direccion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                   </div>
                   <div class="col-sm-2">
                    <label for="" style="text-align: left;">Teléfono
                    </label>
                      <input required type="text" name="telefono_referencia" class="form-control telefono_referencia">
                      <input required type="text" name="telefono_referencia1" class="form-control telefono_referencia1">
                      <input required type="text" name="telefono_referencia2" class="form-control telefono_referencia2">
                   </div>
                   <div class="col-sm-3">
                    <label for="" style="text-align: left;">Ocupación
                    </label>
                    <input required type="text" name="ocupacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" name="ocupacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input required type="text" name="ocupacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                   </div>
                   <div class="col-sm-1">
                    <label for="" style="text-align: left;">Tiempo
                    </label>
                    <input required type="number" name="tiempo" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                    <input required type="number" name="tiempo1" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                    <input required type="number" name="tiempo2" min="1" max="99" step="1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                   </div>
              </div><!--Final Row Referencias-->
            </div> <!--FIN referencias-->
            <!--Inicio Contratación-->
            <div class="tab-pane fade" id="custom-tabs-one-tools" role="tabpanel" aria-labelledby="custom-tabs-one-tools-tab">
               <!--Inicio ROW Contratación-->
              <div class="form-group row">
                <!--Inicio Row contratación-->
                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Tipo de trabajador</label>
                    <select class="custom-select" name="tipo_trabajador">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="EMPLEADO">Administrativo</option>
                      <option value="PATRON">Sindicalizado</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Turno</label>
                    <select class="custom-select" name="turno">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="DIURNO">Diurno</option>
                      <option value="NOCTURNO">Nocturno</option>
                      <option value="MIXTO">Mixto</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Contrato</label>
                    <select class="custom-select" name="contrato">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="PRUEBA">Prueba</option>
                      <option value="DETERMINDO">Tiempo determinado</option>
                      <option value="INDETERMINADO">Tiempo indeterminado</option>
                    </select>
                  </div>
                
                  <div class="col-md-3 mb-2">
                    <label for="validationDefault01">Vigencia</label>
                    <input required type="date" class="form-control" name="vigencia" value="">
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Horario inicio</label>
                    <input required type="time" class="form-control" name="horario_trabajoinicio" value="">
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Horario fin</label>
                    <input required type="time" class="form-control" name="horario_trabajofin" value="">
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Sueldo diario</label>
                    <input required type="number" class="form-control" name="sueldo_diario" value="" maxlength="5" min="0.01" max="10000.00" step="0.01" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Sueldo diario integrado</label>
                    <input required type="number" class="form-control" name="sueldo_integrado" value="" maxlength="5" min="0.01" max="10000.00" step="0.01" onkeypress="return numeros(event)" readonly>
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="validationDefault01">Tabulación<br>Nivel</label>
                    <input required type="text" onkeyup="mayus(this)"; class="form-control" name="nivel" value="">
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Categoria</label>
                    <input required type="text" onkeyup="mayus(this)"; class="form-control" name="categoria" value="">
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Tipo salario</label>
                    <select class="custom-select" name="tipo_salario">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="FIJO">Fijo</option>
                      <option value="VARIABLE">Variable</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Tipo de jornada</label>
                    <select class="custom-select" name="tipo_jornada">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="COMPLETA">Completa</option>
                      <option value="REDUCIDA">Reducida</option>
                    </select>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Jornada <br> Días</label>
                    <input required type="number" class="form-control" name="dias" min="1" max="7" step="1" value="">
                  </div>
                   <div class="col-md-1 mb-3">
                    <br>
                    <label for="validationDefault04">Horas</label>
                    <input required type="number" class="form-control" name="horas_diarias" min="1" max="24" step="any" value="">
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Forma de Pago</label>
                    <select class="custom-select" name="forma_pago">
                      <option selected disabled value="">Seleccione una opción:</option>
                      <option value="EFECTIVO">Efectivo</option>
                      <option value="CHEQUE">Cheque</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Banco</label>
                    <select class="custom-select" name="clave_banco">
                      <option selected disabled value="">Seleccione una opción:</option>
                      @foreach ($bancos as $banco)
                    <option value="{{$banco->clave_banco}}">{{$banco->nombre_banco}}</option>    
                      @endforeach
                      
                    </select>
                  </div>
                  <div class="col-md-4 mb-4">
                    <br>
                    <label for="validationDefault04">Cuenta Bancaria</label>
                    <input required type="text" class="form-control" maxlength="20" name="cuenta_bancaria" value="" onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-4 mb-4">
                    <br>
                    <label for="validationDefault04">Clabe Interbancaria</label>
                    <input required type="text" class="form-control" maxlength="18" name="clabe_interbancaria" value="" onkeypress="return numeros(event)">
                  </div>
                  <!--<div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Envio correspondencia:</label>
                    <input required type="text" class="form-control" name="envio_correspondencia" value="" onkeypress="return numeros(event)">
                  </div>-->

                  <div class="col-md-2 mb-3">
                    <br><br>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="ptu" value="option1" aria-label="">
                      <label for="">Excluir para PTU</label>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="validationDefault04">Observaciones</label>
                    <input required type="text" class="form-control" name="observaciones" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <br>
                  <!--<label for="validationDefault04">Salario base de cotización <br> Actual</label>
                      <input required type="number" class="form-control" name="salario_cotizacion" value="" min="1" max="10000" step="1">
                    </div>
                    <div class="col-md-3 mb-3">
                      <br>
                      <br>
                      <label for="validationDefault04">Anterior</label>
                      <input required type="number" class="form-control" name="salario_anterior" value="" min="1" max="10000" step="1">
                    </div>
                    <div class="col-md-6 mb-3">
                      <br>
                      <br>
                      <label for="validationDefault04">Causa de la modificación</label>
                      <input required type="text" class="form-control" name="causa_modificacion" value="" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>-->
                </div><!--FIN Row contratación-->
              </div><!--FIN ROW Contratación-->
            </div><!--FIN Contratación-->
          </div><!--Final TABCONTENT-->
        </div><!--Final Contenido-->
      </div><!--Final CARD principal-->
    </div><!--Final Col principal-->
  </div><!--Final row principal-->
</div><!--Cierre copy-->
      <div class="modal-footer">
        <div class="col-sm-4">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                </div>
                                <div class="form-group">
                                <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                  <div class="card-body">
                      <div class="margin">
                          <div class="btn-group">
                              <div class="form-group">
                                  <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                              </div>
                              <div class="form-group">
                                <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                              </div>
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
                                  <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                              </div>
                              <div class="form-group">
                                  <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                              </div>
                              <div class="form-group">
                                  <button name="acciones" value="cancelar_actualiza" id="cancelar_actualiza" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </form> 
      </div>
    </div>
  </div>
</div>



