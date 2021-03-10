@extends('layouts.segunda')
@section('content')
<div class="container">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Empleados</h3>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped" id="example1">
        <div class="col-sm-12">
          <div class="card-body">
            <div class="margin">
              <div class="btn-group" style="text-align: center;">
                @canany(['administrador','capturista'])
                  <div class="form-group">
                    <button type="button" style='width:70px; height:40px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                      <i class="fas fa-user-plus"></i>
                    </button>
                  </div>
                @endcanany
              </div>
            </div>
          </div>
          <thead>
            <tr>
              <th>Clave de Empleado</th>
              <th>Nombre de Empleado</th>
              <th>Puesto 
              <th>Departamento</th>
              <th>Área</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($personal))
              @foreach($personal as $persona)
                <tr>
                  <td scope="row">{{ $persona->clave_empleado }}</td>
                  <td>{{ $persona->nombre}} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
                  <td>{{ $persona->nombre_puesto }}</td>
                  <td>{{ $persona->departamento }}</td>
                  <td>{{ $persona->area }}</td>
                  <td style="width: 20%;">
                    @canany(['administrador','capturista'])
                      <div>
                        <a data-target="#modalmodificaempleado{{$persona->id_emp}}" data-toggle="modal">
                          <button type="button" style='width:70px; height:40px; align-items:center;'  >
                            <i class="fas fa-eye"></i>
                          </button>
                        </a>
                    @endcanany
                    @can('administrador')
                        <a id="eliminaempleado" data-target="#modaldeleteempleado{{$persona->id_emp}}" data-toggle="modal" style='width:70px; height:40px'>
                          <button type="button" style='width:70px; height:40px'>
                              <i class="far fa-trash-alt"></i>
                          </button>
                        </a>
                        <!--Incluye los modales por cada accion de eliminar generando sean direfentes los ID -->
                        @include('empleados.modaldeleteempleado')
                        @include('empleados.modalmostrarporid')                
                      </div>
                    @endcan
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </div>
      </table> 
    </div>
  </div>
  @include('empleados.modalcrudinicialempleados')
</div>
@endsection