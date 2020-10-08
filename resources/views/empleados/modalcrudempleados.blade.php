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
              <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Referencias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-tools-tab" data-toggle="pill" href="#custom-tabs-one-tools" role="tab" aria-controls="custom-tabs-one-tools" aria-selected="false">Contratación</a>
            </li>
          </ul>
        </div><!--Final Cabeceras-->
        <!--Inicio contenido-->
        <div class="card-body">
          <!--General TABCONTENT-->
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <!--Inicio Personal-->
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            <form method="GET" action="{{route('empleados.index')}}" enctype="multipart/form-data"><!--Inicio FORM-->
                <div class="form-row">
                  <div class="col-md-1 mb-2">
                    <label for="validationDefault01">Clave:</label>
                    <input type="text" class="form-control" name="clave_empleado" value="" onkeypress="return numeros(event)" readonly>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault02">Clasificación:</label>
                    <input type="text" class="form-control" name="clasificacion" value="" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required  onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Paterno:</label>
                    <input type="text" class="form-control" name="apellido_paterno" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Materno:</label>
                    <input type="text" class="form-control" name="apellido_materno" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de alta:</label>
                    <input type="date" class="form-control" name="fecha_alta" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de baja:</label>
                    <input type="date" class="form-control" name="fecha_baja">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Causa de baja:</label>
                    <select class="custom-select" name="causa_baja">
                      <option selected  value=""></option>
                      <option>Renuncia</option>
                      <option>Despido</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Departamento:</label>
                    <select class="custom-select" name="clave_departamento" required>
                      <option selected disabled value="">Selecciona una opcion</option>
                      @foreach ($departamentos as $depa)
                    <option value="{{$depa->clave_departamento}}">{{$depa->departamento}}</option>    
                      @endforeach
                      
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Puesto:</label>
                    <select class="custom-select" name="clave_puesto" required>
                      <option selected disabled value="">Selecciona una opcion</option>
                      @foreach ($puestos as $puest)
                    <option value="{{$puest->clave_puesto}}">{{$puest->nombre_puesto}}</option>    
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">RFC:</label>
                    <input type="text" class="form-control" maxlength="13" name="rfc" onkeyup="mayus(this);"  required>
                  </div>
                   <div class="col-md-2">
                    <label for="validationDefault03">CURP:</label>
                    <input type="text" class="form-control" minlength="18" maxlength="18" name="curp" onkeyup="mayus(this);" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">IMSS:</label>
                    <input type="text" class="form-control" minlength="11" maxlength="11" name="imss" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Afore:</label>
                    <input type="text" class="form-control" name="afore" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">INE:</label>
                    <input type="text" class="form-control" maxlength="18" name="ine" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Pasaporte:</label>
                    <input type="text" class="form-control" name="pasaporte" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Cartilla:</label>
                    <input type="text" class="form-control" name="cartilla" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Licencia:</label>
                    <input type="text" class="form-control" name="licencia" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Documento migratorio:</label>
                    <input type="text" class="form-control" name="documento_migratorio" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Calle:</label>
                    <input type="text" class="form-control" name="calle" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Número externo:</label>
                    <input type="text" class="form-control" name="numero_externo" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Número interno:</label>
                    <input type="text" class="form-control" name="numero_interno" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">CP:</label>
                    <input type="text" class="form-control" name="cp" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado:</label>
                    <input type="text" class="form-control" name="estado" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Telefono:</label>
                    <input type="text" class="form-control telefono_empleado" name="telefono_empleado" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Correo:</label>
                    <input type="text" class="form-control" name="correo" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Sexo:</label>
                    <select class="custom-select" name="sexo" required>
                      <option selected disabled value="">Seleccione una opción</option>
                      <option value="HOMBRE">Hombre</option>
                      <option value="MUJER">Mujer</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Estado Civil:</label>
                    <select class="custom-select" name="estado_civil" required>
                      <option selected disabled value="">Selecciona una opción</option>
                      <option value="SOLTERO">Soltero</option>
                      <option value="CASADO">Casado</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Tipo de sangre:</label>
                    <input type="text" class="form-control" name="tipo_sangre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Alergias:</label>
                    <input type="text" class="form-control" name="alergias" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Estatura:</label>
                    <input type="text" class="form-control"  name="estatura" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Peso:</label>
                    <input type="text" class="form-control" name="peso" required onkeypress="return numeros(event)">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado de salud:</label>
                    <input type="text" class="form-control" name="estado_salud" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Foto:</label>
                    <input type="file" class="form-control" name="fotografia" required>
                  </div>
                </div><!--Fin  Row Personal-->
            </div><!--Fin  Personal-->
            <!--Inicio Personal 1-->
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
              <div class="form-row"><!--Inicio Row Personal 1-->
                <div class="col-md-3 mb-2">
                <label for="validationDefault01">Enfermedad Crónica:</label>
                <input type="text" class="form-control" name="enfermedad_cronica" value="" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3">
                <label for="validationDefault02">Práctica de Deportes:</label>
                <input type="text" class="form-control" name="deporte" value="" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Pasatiempos:</label>
                <input type="text" class="form-control" name="pasatiempo" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Asociación, Club Social o Deportivo:</label>
                <input type="text" class="form-control" name="asosiacion" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Objetivo de Vida:</label>
                <input type="text" class="form-control" name="objetivo_vida" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Lugar de Origen:</label>
                <input type="text" class="form-control" name="lugar" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">UMF:</label>
                <input type="text" class="form-control" name="umf" required>
              </div>
               <div class="col-md-4 mb-3">
                <label for="validationDefault03">Nombre del Padre:</label>
                <input type="text" class="form-control" name="nombre_padre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>

              <div class="col-md-1 mb-3">
                <br>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="finado_padre" value="option1" aria-label="">
                <label for="">Finado</label>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Direccion:</label>
                <input type="text" class="form-control" name="direccion_padre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupacion:</label>
                <input type="text" class="form-control" name="ocupacion_padre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Nombre de la Madre:</label>
                <input type="text" class="form-control" name="nombre_madre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-1 mb-3">
                <br>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="finado_madre" value="option1" aria-label="">
                <label for="">Finado</label>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Direccion:</label>
                <input type="text" class="form-control" name="direccion_madre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupacion:</label>
                <input type="text" class="form-control" name="ocupacion_madre" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault03">Nombre y edad de sus Hijos:</label>
                <input type="text" class="form-control" name="hijos" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Idiomas:</label>
                <input type="text" class="form-control" name="idiomas" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Funciones de Oficina:</label>
                <input type="text" class="form-control" name="funciones_oficina" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Maquinas de Oficina o Taller que Maneje:</label>
                <input type="text" class="form-control" name="maquinas_oficina" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Software que conoce:</label>
                <input type="text" class="form-control" name="software" required onkeyup="mayus(this);" onkeypress="return validar(event)">
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Otras funciones o trabajos que domina:</label>
                <input type="text" class="form-control" name="otras_funciones" required onkeyup="mayus(this);" onkeypress="return validar(event)">
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
                    </label> 
                </div>
                 <div class="col-md-4 mb-3">
                  <label for="validationDefault03">Nombre</label>
                    <input type="text" class="form-control" name="beneficiario" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="beneficiario1" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="beneficiario2" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="beneficiario3" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="beneficiario4" required onkeyup="mayus(this);" onkeypress="return validar(event)"> 
                 </div>
                 <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Parentesco</label>
                    <input type="text" class="form-control" name="parentesco" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="parentesco1" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="parentesco2" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="parentesco3" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" class="form-control" name="parentesco4" required onkeyup="mayus(this);" onkeypress="return validar(event)"> 
                 </div>

                 <div class="col-md-3 mb-3">
                  <label for="validationDefault03">% de Participacion</label>
                  <input type="text" class="form-control" name="porcentaje" maxlength="2" required onkeypress="return numeros(event)">
                  <input type="text" class="form-control" name="porcentaje1" maxlength="2" required onkeypress="return numeros(event)">
                  <input type="text" class="form-control" name="porcentaje2" maxlength="2" required onkeypress="return numeros(event)">
                  <input type="text" class="form-control" name="porcentaje3" maxlength="2" required onkeypress="return numeros(event)">
                  <input type="text" class="form-control" name="porcentaje4" maxlength="2" required onkeypress="return numeros(event)">
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
                    <p><label for="pensamiento_id" style="text-align: justify;">Inicio: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Finalizo:</label></p>
                   </div>
                   
                   <div class="col-sm-3">
                    <p><label for="pensamiento_id" style="text-align: justify;">Titulo obtenido</label></p>
                   </div>
              <!--Fin titulos-->
              <!--Inicio Primaria-->
                <label for="" class="col-form-label col-sm-2">Primaria</label>
                <div class="col-sm-3">
                  <input type="text" name="primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input name="duracion_primaria" class="form-control" id="duracion5">
                </div>
              
                <div class="col-sm-3">
                  <input type="text" name="titulo_primaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Primaria-->
               <!--Inicio Secundaria-->
                <label for="" class="col-form-label col-sm-2">Secundaria</label>
                <div class="col-sm-3">
                  <input type="text" name="secundaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input name="duracion_secundaria" class="form-control" id="duracion6">
                </div>
               
                <div class="col-sm-3">
                  <input type="text" name="titulo_secundaria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Secundaria-->
              <!--Inicio Preparatoria-->
                <label for="" class="col-form-label col-sm-2">Preparatoria</label>
                <div class="col-sm-3">
                  <input type="text" name="preparatoria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input  name="duracion_preparatoria" class="form-control" id="duracion7">
                </div>
               
                <div class="col-sm-3">
                  <input type="text" name="titulo_preparatoria" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Preparatoria-->
              <!--Inicio Profesional-->
                <label for="" class="col-form-label col-sm-2">Profesional</label>
                <div class="col-sm-3">
                  <input type="text" name="profesional" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input name="duracion_profesional" class="form-control" id="duracion8">
                </div>
                
                <div class="col-sm-3">
                  <input type="text" name="titulo_profesional" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Profesional-->
               
               <!--Inicio Otras-->
                <label for="" class="col-form-label col-sm-2">Otras</label>
                <div class="col-sm-3">
                  <input type="text" name="otras" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
                <div class="col-sm-4">
                  <input  name="duracion_otras" class="form-control" id="duracion9">
                </div>
             
                <div class="col-sm-3">
                  <input type="text" name="titulo_otras" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                </div>
              <!--FIN Profesional-->
              <div class="col-sm-12">
                    <label for="" style="text-align: left;">
                      <br><h4><strong>Estudios actuales</strong></h4>
                    </label> 
                </div>
               <div class="col-md-5">
                <label for="validationDefault03">Nombre de la Institucion</label>
                <input type="text" class="form-control" name="estudio_actual" required onkeyup="mayus(this);" onkeypress="return validar(event)">       
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Curso o Carrera</label>
                <input type="text" class="form-control" name="carrera" required onkeyup="mayus(this);" onkeypress="return validar(event)">
                
               </div>
               <div class="col-md-1 mb-3">
                <label for="validationDefault03">Grado </label>
                <input type="text" class="form-control" name="grado" maxlength="2" required onkeypress="return numeros(event)">
                
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Horario </label>
                <input type="text" class="form-control" name="horario" required>      
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
                      <h6><strong>Tiempo que presto su servicios</strong></h6>
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
                      <input  name="duracion_trabajo" class="form-control" id="duracion">
                   </div>
                   <div class="col-sm-3"> 
                      <input  name="duracion_trabajo1" class="form-control" id="duracion2">
                   </div>
                   <div class="col-sm-3"> 
                      <input name="duracion_trabajo2" class="form-control" id="duracion3">
                   </div>
                   <div class="col-sm-3"> 
                      <input name="duracion_trabajo3" class="form-control" id="duracion4">
                   </div>




                   
                    <label for="" class="col-form-label col-sm-12">Nombre de la Compañia:
                    </label>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_compania" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)" >
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_compania1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_compania2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_compania3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--Fin compañia Referencias-->
                    <!--Inicio Dirección Referencias-->
                    <label for="" class="col-form-label col-sm-12">Direccion:</label>
                      <div class="col-sm-3">
                        <input type="text" name="direccion_compania" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                    <div class="col-sm-3">
                        <input type="text" name="direccion1_trabajo1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="direccion2_compania2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="direccion3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--Fin Dirección Referencias-->
                    <!--Inicio Telefono Referencias-->
                    <label for="" class="col-form-label col-sm-12">Telefono:</label>
                    <div class="col-sm-3">
                      <input type="text" name="telefono_compania" class="form-control telefono_compania" placeholder="" tabindex="1">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="telefono1" class="form-control telefono1">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="telefono2" class="form-control telefono2">
                    </div>
                    <div class="col-sm-3">
                    <input type="text" name="telefono3" class="form-control telefono3">
                    </div><!--FIN Telefono Referencias-->
                    <!--INCIO sueldo Referencias-->
                    <label for="" class="col-form-label col-sm-12">Sueldo:</label>
                    <div class="col-sm-3">
                      <input type="text" name="sueldo" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="sueldo1" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="sueldo2" class="form-control" onkeypress="return numeros(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="sueldo3" class="form-control" onkeypress="return numeros(event)">
                    </div><!--FIN sueldo Referencias-->
                    <!--INCIO Motivo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Motivo de la Separacion:</label>
                    <div class="col-sm-3">
                      <input type="text" name="motivo_separacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="motivo_separacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="motivo_separacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="motivo_separacion3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--FIN Motivo separación Referencias-->
                    <!--INCIO Jefe Directo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Nombre del Jefe Directo:</label>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="nombre_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div><!--FIN Jefe Directo separación Referencias-->
                    <!--INCIO Puesto Jefe Directo separación Referencias-->
                    <label for="" class="col-form-label col-sm-12">Puesto del Jefe Inmediato:</label>
                    <div class="col-sm-3">
                      <input type="text" name="puesto_jefe" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="puesto_jefe1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="puesto_jefe2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-3">
                      <input type="text" name="puesto_jefe3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
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
                     <label for="" class="col-form-label col-sm-12">Razones:</label>
                      <div class="col-sm-3">
                        <input type="text" name="razones" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" name="razones1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div>
                      <div class="col-sm-3">
                      <input type="text" name="razones2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                        </div>
                      <div class="col-sm-3">
                        <input type="text" name="razones3" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      </div><!--FIN Razones Informes separación Referencias-->
                      <div class="col-sm-12">
                        <p><label for="" style="text-align: left;">
                          <h4><strong>Referencias</strong></h4>
                        </label></p>
                      </div>
                    <div class="col-sm-3">
                      <label for="" style="text-align: left;"> Nombre
                      </label>
                      <input type="text" name="referencia" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input type="text" name="referencia1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input type="text" name="referencia2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    </div>
                    <div class="col-sm-2">
                      <label for="" style="text-align: left;">Dirección 
                    </label>
                      <input type="text" name="direccion_trabajo" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input type="text" name="direccion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                      <input type="text" name="direccion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                   </div>
                   <div class="col-sm-2">
                    <label for="" style="text-align: left;">Teléfono
                    </label>
                      <input type="text" name="telefono_referencia" class="form-control telefono_referencia">
                      <input type="text" name="telefono_referencia1" class="form-control telefono_referencia1">
                      <input type="text" name="telefono_referencia2" class="form-control telefono_referencia2">
                   </div>
                   <div class="col-sm-3">
                    <label for="" style="text-align: left;">Ocupación
                    </label>
                    <input type="text" name="ocupacion" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" name="ocupacion1" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                    <input type="text" name="ocupacion2" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                   </div>
                   <div class="col-sm-1">
                    <label for="" style="text-align: left;">Tiempo
                    </label>
                    <input type="text" name="tiempo" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                    <input type="text" name="tiempo1" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                    <input type="text" name="tiempo2" class="form-control" maxlength="2" onkeypress="return numeros(event)">
                   </div>
              </div><!--Final Row Referencias-->
            </div> <!--FIN referencias-->
            <!--Inicio Contratación-->
            <div class="tab-pane fade" id="custom-tabs-one-tools" role="tabpanel" aria-labelledby="custom-tabs-one-tools-tab">
               <!--Inicio ROW Contratación-->
              <div class="form-group row">
                <!--Inicio Row contratación-->
                <div class="form-row">
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Tipo de trabajador</label>
                    <select class="custom-select" name="tipo_trabajador" required>
                      <option selected disabled value="">Seleccioe una opcion:</option>
                      <option value="EMPLEADO">Empleado</option>
                      <option value="PATRON">Patron</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Turno</label>
                    <select class="custom-select" name="turno" required>
                      <option selected disabled value="">Selecciona una opcion:</option>
                      <option value="MATUTINO">MATUTINO</option>
                      <option value="VESPERTINO">VESPERTINO</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault04">Contrato</label>
                    <select class="custom-select" name="contrato" required>
                      <option selected disabled value="">Selecciona una opcion</option>
                      <option value="PRUEBA">Prueba</option>
                      <option value="TEMPORAL">Temporal</option>
                      <option value="INDETERMINADO">Permanente</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Contrato documento:</label>
                    <input type="file" class="form-control" name="contrato_documento" accept="application/pdf" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="validationDefault01">Vigencia</label>
                    <input type="date" class="form-control" name="vigencia" value="" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Horario inicio</label>
                    <input type="time" class="form-control" name="horario_trabajoinicio" value="" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Horario fin</label>
                    <input type="time" class="form-control" name="horario_trabajofin" value="" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Sueldo diario</label>
                    <input type="text" class="form-control" name="sueldo_diario" value="" maxlength="5" onkeypress="return numeros(event)" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <label for="validationDefault01">Tabulación<br>Nivel</label>
                    <input type="text" class="form-control" name="nivel" value="" required>
                  </div>
                  <div class="col-md-2 mb-2">
                    <br>
                    <label for="validationDefault01">Categoria</label>
                    <input type="text" class="form-control" name="categoria" value="" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Tipo salario</label>
                    <select class="custom-select" name="tipo_salario" required>
                      <option selected disabled value="">Seleccione una opcion</option>
                      <option value="FIJO">Fijo</option>
                      <option value="VARIABLE">Variable</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Tipo de jornada</label>
                    <select class="custom-select" name="tipo_jornada" required>
                      <option selected disabled value="">Seleccione una opcion</option>
                      <option value="COMPLETA">Completa</option>
                      <option value="REDUCIDA">Reducida</option>
                    </select>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Jornada <br> Días</label>
                    <input type="text" class="form-control" name="dias" value="" required>
                  </div>
                   <div class="col-md-1 mb-3">
                    <br>
                    <label for="validationDefault04">Horas</label>
                    <input type="text" class="form-control" name="horas_diarias" value="" onkeypress="return numeros(event)" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Forma de Pago</label>
                    <select class="custom-select" name="forma_pago" required>
                      <option selected disabled value="">Selecciona una opcion</option>
                      <option value="EFECTIVO">Efectivo</option>
                      <option value="CHEQUE">Cheque</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Banco</label>
                    <select class="custom-select" name="clave_banco" required>
                      <option selected disabled value="">Selecciona una opcion</option>
                      @foreach ($bancos as $banco)
                    <option value="{{$banco->clave_banco}}">{{$banco->banco}}</option>    
                      @endforeach
                      
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <label for="validationDefault04">Tarjeta bancaria</label>
                    <input type="text" class="form-control" name="tarjeta_banco" value="" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <br><br>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="ptu" value="option1" aria-label="">
                      <label for="">Excluir ara PTU</label>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="validationDefault04">Obervaciones</label>
                    <input type="text" class="form-control" name="observaciones" value="" onkeyup="mayus(this);" onkeypress="return validar(event)" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Salario base de cotización <br> Actual</label>
                    <input type="text" class="form-control" name="salario_cotizacion" value="">
                  </div>
                  <div class="col-md-2 mb-3">
                    <br>
                    <br>
                    <label for="validationDefault04">Anterior</label>
                    <input type="text" class="form-control" name="salario_anterior" value="" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <br>
                    <br>
                    <label for="validationDefault04">Causa de la modificación</label>
                    <input type="text" class="form-control" name="causa_modificacion" value="" onkeyup="mayus(this);" onkeypress="return validar(event)" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <br>
                    <br>
                    <label for="validationDefault03">Contrato documento:</label>
                    <input type="file" class="form-control" name="firma" accept="application/pdf" required>
                  </div>


                </div><!--FIN Row contratación-->
              </div><!--FIN ROW Contratación-->
            </div><!--FIN Contratación-->
          </div><!--Final TABCONTENT-->
        </div><!--Final Contenido-->
      </div><!--Final CARD principal-->
    </div><!--Final Col principal-->
  </div><!--Final row principal-->
</div><!--Cierre copy-->
      </div>


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

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



