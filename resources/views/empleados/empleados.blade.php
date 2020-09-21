@extends('layouts.segunda')

@section('content')

  <div class="container">
    <div class="row">
    <div class="col-md-12">
      <div class="card card-secondary card-tabs">
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
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <form>
                <div class="form-row">
                  <div class="col-md-1 mb-2">
                    <label for="validationDefault01">Clave:</label>
                    <input type="text" class="form-control" name="clave_empleado" value="" required>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault02">Clasificación:</label>
                    <input type="text" class="form-control" name="clasificacion" value="Otto" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Paterno:</label>
                    <input type="text" class="form-control" name="apellido_paterno" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Materno:</label>
                    <input type="text" class="form-control" name="apellido_materno" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de alta:</label>
                    <input type="date" class="form-control" name="fecha_alta" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de baja:</label>
                    <input type="date" class="form-control" name="fecha_baja" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Causa de baja:</label>
                    <select class="custom-select" name="causa_baja" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Departamento:</label>
                    <select class="custom-select" name="clave_departamento" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Puesto:</label>
                    <select class="custom-select" name="clave_puesto" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">RFC:</label>
                    <input type="text" class="form-control" name="rfc" required>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault03">CURP:</label>
                    <input type="text" class="form-control" name="curp" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">IMSS:</label>
                    <input type="text" class="form-control" name="imss" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Afore:</label>
                    <input type="text" class="form-control" name="afore" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">INE:</label>
                    <input type="text" class="form-control" name="ine" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Pasaporte:</label>
                    <input type="text" class="form-control" name="pasaporte" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Cartilla:</label>
                    <input type="text" class="form-control" name="cartilla" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Licencia:</label>
                    <input type="text" class="form-control" name="licencia" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Documento migratorio:</label>
                    <input type="text" class="form-control" name="documento_migratorio" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Calle:</label>
                    <input type="text" class="form-control" name="calle" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Numero externo:</label>
                    <input type="text" class="form-control" name="numero_externo" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Numero interno:</label>
                    <input type="text" class="form-control" name="numero_interno" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">CP:</label>
                    <input type="text" class="form-control" name="cp" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado:</label>
                    <input type="text" class="form-control" name="estado" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Telefono:</label>
                    <input type="text" class="form-control" name="telefono_empleado" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Correo:</label>
                    <input type="text" class="form-control" name="correo" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Sexo:</label>
                    <select class="custom-select" name="sexo" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Estado Civil:</label>
                    <select class="custom-select" name="estado_civil" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Nacionalidad:</label>
                    <select class="custom-select" name="nacionalidad" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Tipo de sangre:</label>
                    <select class="custom-select" name="tipo_sangre" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Alergias:</label>
                    <input type="text" class="form-control" name="alergias" required>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Estatura:</label>
                    <input type="text" class="form-control"  name="estatura" required>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Peso:</label>
                    <input type="text" class="form-control" name="peso" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado de salud:</label>
                    <input type="text" class="form-control" name="estado_salud" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Foto:</label>
                    <input type="file" class="form-control" name="fotografia" required>
                  </div>
                </div>
              
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
              <div class="form-row">
              <div class="col-md-3 mb-2">
                <label for="validationDefault01">Enfermedad Crónica:</label>
                <input type="text" class="form-control" name="enfermedad_cronica" value="Mark" required>
              </div>
              <div class="col-md-3">
                <label for="validationDefault02">Práctica de Deportes:</label>
                <input type="text" class="form-control" name="deporte" value="Otto" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Pasatiempos:</label>
                <input type="text" class="form-control" name="pasatiempo" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Asociación, Club Social o Deportivo:</label>
                <input type="text" class="form-control" name="asosiacion" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Objetivo de Vida:</label>
                <input type="text" class="form-control" name="objetivo_vida" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Lugar de Origen:</label>
                <input type="text" class="form-control" name="lugar" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">UMF:</label>
                <input type="text" class="form-control" name="umf" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nombre del Padre:</label>
                <input type="text" class="form-control" name="nombre_padre" required>
              </div>
              <div class="form-check">

                <input class="form-check-input position-static" type="checkbox" name="finado_padre" value="option1" aria-label="...">
                <label for="">Finado:</label>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Direccion:</label>
                <input type="text" class="form-control" name="direccion_padre" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupacion:</label>
                <input type="text" class="form-control" name="ocupacion_padre" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nombre de la Madre:</label>
                <input type="text" class="form-control" name="nombre_madre" required>
              </div>
              <div class="form-check">

                <input class="form-check-input position-static" type="checkbox" name="finado_madre" value="option1" aria-label="...">
                <label for="">Finado:</label>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Direccion:</label>
                <input type="text" class="form-control" name="direccion_madre" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Ocupacion:</label>
                <input type="text" class="form-control" name="ocupacion_madre" required>
              </div>
              <div class="col-md-8 mb-3">
                <label for="validationDefault03">Nombre y edad de sus Hijos:</label>
                <input type="text" class="form-control" name="hijos" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Idiomas:</label>
                <input type="text" class="form-control" name="idiomas" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Funciones de Oficina:</label>
                <input type="text" class="form-control" name="funciones_oficina" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Maquinas de Oficina o Taller que Maneje:</label>
                <input type="text" class="form-control" name="maquinas_oficina" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Software que conoce:</label>
                <input type="text" class="form-control" name="software" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">Otras funciones o trabajos que domina:</label>
                <input type="text" class="form-control" name="otras_funciones" required>
              </div>
            </div>
            </div>

            
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
              <div class="form-row">
                 <div class="col-md-4 mb-3">
                  <label for="validationDefault03">Beneficiarios</label>
                    <input type="text" class="form-control" name="beneficiario" required>
                    <input type="text" class="form-control" name="beneficiario1" required>
                    <input type="text" class="form-control" name="beneficiario2" required>
                    <input type="text" class="form-control" name="beneficiario3" required>
                    <input type="text" class="form-control" name="beneficiario4" required> 
                 </div>
                 <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Parentesco</label>
                    <input type="text" class="form-control" name="parentesco" required>
                    <input type="text" class="form-control" name="parentesco1" required>
                    <input type="text" class="form-control" name="parentesco2" required>
                    <input type="text" class="form-control" name="parentesco3" required>
                    <input type="text" class="form-control" name="parentesco4" required> 
                 </div>

                 <div class="col-md-3 mb-3">
                  <label for="validationDefault03">% de Participacion</label>
                  <input type="text" class="form-control" name="porcentaje" required>
                  <input type="text" class="form-control" name="porcentaje1" required>
                  <input type="text" class="form-control" name="porcentaje2" required>
                  <input type="text" class="form-control" name="porcentaje3" required>
                  <input type="text" class="form-control" name="porcentaje4" required>
                 </div>
                
             
                
            
                <div class="form-row">
                
                  <div>
                <br><br>
                     <label for="">Primaria</label><br>
                     <label for="">Secundaria</label><br>
                     <label for="">Preparatoria</label><br>
                     <label for="">Profesional</label><br>
                     <label for="">Otras</label>
                  </div>
                  <div class="col-md-6">
                    <label for="">Nombre Institucion </label>
                    <input type="text" class="form-control" name="primaria" required>
                    <input type="text" class="form-control" name="secundaria" required>
                    <input type="text" class="form-control" name="preparatoria" required>
                    <input type="text" class="form-control" name="profesional" required>
                    <input type="text" class="form-control" name="otras" required>
                 </div>
                 
                  <div class="col-md-4">
                  <label for="validationDefault03">Inicio</label>
                  <input type="date" class="form-control" name="inicio_primaria" required>
                  <input type="date" class="form-control" name="inicio_secundaria" required>
                  <input type="date" class="form-control" name="inicio_preparatoria" required>
                  <input type="date" class="form-control" name="inicio_profesional" required> 
                  <input type="date" class="form-control" name="inicio_otras" required> 
                 </div>

               
              
              </div>
              <div class="col-md-2">
                <label for="validationDefault03">Finalizo</label>
                <input type="date" class="form-control" name="fin_primaria" required>
                <input type="date" class="form-control" name="fin_secundaria" required>
                <input type="date" class="form-control" name="fin_preparatoria" required>
                <input type="date" class="form-control" name="fin_profesional" required> 
                <input type="date" class="form-control" name="fin_otras" required> 
              </div>
                 
              <div class="col-md-3">
                <label for="validationDefault03">Titulo Obtenido:</label>
                <input type="text" class="form-control" name="titulo_primaria" required>
                <input type="text" class="form-control" name="titulo_secundaria" required>
                <input type="text" class="form-control" name="titulo_preparatoria" required>
                <input type="text" class="form-control" name="titulo_profesional" required> 
                <input type="text" class="form-control" name="titulo_otras" required> 
              </div>
              <div class="col-md-3">
                <label for="validationDefault03">Nombre de la Institucion</label>
                <input type="text" class="form-control" id="validationDefault03" required>
                
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Curso o Carrera</label>
                <input type="text" class="form-control" id="validationDefault03" required>
                
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Grado </label>
                <input type="text" class="form-control" id="validationDefault03" required>
                
               </div>
               <div class="col-md-3 mb-3">
                <label for="validationDefault03">Horario </label>
                <input type="text" class="form-control" id="validationDefault03" required>
                
               </div>
              </div>
           </div>

            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">

            <div class="form-group row">
                
                 <label for="" class="col-form-label col-sm-3">Empleos</label>
                   <div class="col-sm-2">
                    <p><label for="pensamiento_id" style="text-align: justify;">Actual ó último <br>De &nbsp &nbsp &nbsp &nbsp A</label></p>
                   </div>
                   <div class="col-sm-2">
                    <p><label for="pensamiento_id" style="text-align: justify;">Anterior <br>De &nbsp &nbsp &nbsp &nbsp &nbsp  A</label></p>
                   </div>
                   <div class="col-sm-2">
                    <p><label for="pensamiento_id" style="text-align: justify;">Anterior <br>De &nbsp &nbsp &nbsp &nbsp &nbsp  A</label></p>
                   </div>
                   <div class="col-sm-2">
                    <p><label for="pensamiento_id" style="text-align: justify;">Anterior <br>De &nbsp &nbsp &nbsp &nbsp &nbsp  A</label></p>
                   </div>
              </div>

            
              <div class="form-group row">
                
                 <label for="" class="col-form-label col-sm-3">Tiempo que presto sus  servicios:</label>
                   <div class="col-sm-2">
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
                   <div class="col-sm-2">
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
                   <div class="col-sm-2">
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
                   <div class="col-sm-2">
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-form-label col-sm-3">Nombre de la Compañia:
                </label>
                  <div class="col-sm-2">
                     <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                 </div>
                 <div class="col-sm-2">
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
               </div>
               <div class="col-sm-2">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
             </div>
             </div>
             <div class="form-group row">
              <label for="" class="col-form-label col-sm-3">Direccion:</label>
                <div class="col-sm-2">
                   <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                </div>
                <div class="col-sm-2">
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
               </div>
               <div class="col-sm-2">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
             </div>
             <div class="col-sm-2">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
           </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-form-label col-sm-3">Telefono:</label>
              <div class="col-sm-2">
                 <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
              </div>
              <div class="col-sm-2">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
             </div>
             <div class="col-sm-2">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
           </div>
           <div class="col-sm-2">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
         </div>
         </div>
         <div class="form-group row">
          <label for="" class="col-form-label col-sm-3">Sueldo:</label>
            <div class="col-sm-2">
               <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
            </div>
            <div class="col-sm-2">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
           </div>
           <div class="col-sm-2">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
         </div>
         <div class="col-sm-2">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
       </div>
       </div>
       <div class="form-group row">
        <label for="" class="col-form-label col-sm-3">Motivo de la Separacion:</label>
          <div class="col-sm-2">
             <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
          </div>
          <div class="col-sm-2">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
         </div>
         <div class="col-sm-2">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
       </div>
       <div class="col-sm-2">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
     </div>
     </div>
     <div class="form-group row">
      <label for="" class="col-form-label col-sm-3">Nombre del Jefe Directo:</label>
        <div class="col-sm-2">
           <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
        </div>
        <div class="col-sm-2">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
       </div>
       <div class="col-sm-2">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
     </div>
     <div class="col-sm-2">
      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
   </div>
   </div>
   <div class="form-group row">
    <label for="" class="col-form-label col-sm-3">Puesto del Jefe Inmediato:</label>
      <div class="col-sm-2">
         <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
      </div>
      <div class="col-sm-2">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
     </div>
     <div class="col-sm-2">
      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
   </div>
   <div class="col-sm-2">
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
 </div>
 </div>
 <div class="form-group row">
  <label for="" class="col-form-label col-sm-3">Podemos Solicitar Informes:</label>
    <div class="col-sm-2">
       <input type="checkbox" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
    </div>
    <div class="col-sm-2">
      <input type="checkbox" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
   </div>
   <div class="col-sm-2">
    <input type="checkbox" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
 </div>
 <div class="col-sm-2">
  <input type="checkbox" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
</div>
 
</div>
<div class="form-group row">
  <label for="" class="col-form-label col-sm-3">Razones:</label>
    <div class="col-sm-2">
       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
    </div>
    <div class="col-sm-2">
      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
   </div>
   <div class="col-sm-2">
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
 </div>
 <div class="col-sm-2">
  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
</div>

            <div class="form-group row">
               <div class="col-sm-12">
                    <p><label for="pensamiento_id" style="text-align: left;">
                      <h4><strong>Referencias</strong></h4>
                    </label></p>
                    
                   </div>
                
                <div class="col-sm-3">
                    <p><label for="pensamiento_id" style="text-align: left;">             Nombre
                    </label></p>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"> <br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                </div>
                 

                <div class="col-sm-4">
                    <p><label for="pensamiento_id" style="text-align: left;">
                      
                      Dirección y Teléfono
                    </label></p>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                     <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                   </div>
                   <div class="col-sm-3">
                    <p><label for="pensamiento_id" style="text-align: left;">
                    
                      Ocupación
                    </label></p>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
                   <div class="col-sm-1">
                    <p><label for="pensamiento_id" style="text-align: left;">
                      
                      Tiempo
                    </label></p>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1"><br>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" tabindex="1">
                   </div>
              </div>

<div class="form-group row">


</div>

            </div>


          </div>
        </div>
      </form>
        <!-- /.card -->
      </div>
  </div>
    </div>
  </div></div>
@endsection