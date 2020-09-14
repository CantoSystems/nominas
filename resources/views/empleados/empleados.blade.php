@extends('layouts.segunda')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-tabs">
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
              <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Referecnias</a>
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
                    <input type="text" class="form-control" id="validationDefault01" value="Mark" required>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault02">Clasificación:</label>
                    <input type="text" class="form-control" id="validationDefault02" value="Otto" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Nombre:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Apellido Materno:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de alta:</label>
                    <input type="date" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Fecha de baja:</label>
                    <input type="date" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Causa de baja:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Departamento:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Puesto:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">RFC:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2">
                    <label for="validationDefault03">CURP:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">IMSS:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Afore:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">INE:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Pasaporte:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Cartilla:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Licencia:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Documento migratorio:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Calle:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Colonia:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">CP:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Ciudad:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Municipio:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Telefono:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Correo:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Telefono:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Sexo:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Estado Civil:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Nacionalidad:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault04">Tipo de sangre:</label>
                    <select class="custom-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Alergias:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Estatura:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="validationDefault03">Peso:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Estado de salud:</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="validationDefault03">Foto:</label>
                    <input type="file" class="form-control" id="validationDefault03" required>
                  </div>
                </div>
              
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
              <div class="form-row">
              <div class="col-md-3 mb-2">
                <label for="validationDefault01">Enfermedad Crónica:</label>
                <input type="text" class="form-control" id="validationDefault01" value="Mark" required>
              </div>
              <div class="col-md-2">
                <label for="validationDefault02">Práctica de Deportes:</label>
                <input type="text" class="form-control" id="validationDefault02" value="Otto" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Pasatiempos:</label>
                <input type="text" class="form-control" id="validationDefault03" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Asociación, Club Social o Deportivo:</label>
                <input type="text" class="form-control" id="validationDefault03" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Objetivo de Vida:</label>
                <input type="text" class="form-control" id="validationDefault03" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Nacimiento:</label>
                <input type="date" class="form-control" id="validationDefault03" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">Lugar de Origen:</label>
                <input type="text" class="form-control" id="validationDefault03" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationDefault03">UMF:</label>
                <input type="text" class="form-control" id="validationDefault03" required>
              </div>
              <div class="form-check">
               
                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                <label for="">Administrador unico:</label>
              </div>
            </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
               Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
               Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
            </div>
          </div>
        </div>
      </form>
        <!-- /.card -->
      </div>
    </div>
  </div>
@endsection