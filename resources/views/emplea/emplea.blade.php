@extends('layouts.segunda')
@section('content')
<div class="container">
  <div class="col-md-12">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Empleados</h3>
    </div>
  </div>
    <div class="card-body">
      <div class="margin">
        <div class="btn-group">
                @canany(['administrador','capturista'])
                  <div class="form-group">
                    <button type="button" class="botonesgrandes" data-toggle="modal" data-target="#modalregistroempleado">
                      <i class="fas fa-user-plus"></i>
                    </button>
                  </div>
                @endcanany
        </div>
        <table class="table table-bordered table-striped" id="example1">
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
              <!--Inicio del Foreach-->
                <tr>
                  <td scope="row">valor 1</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="width: 20%;">
                    @canany(['administrador','capturista'])
                        <a data-target="#modalmodificaempleado" data-toggle="modal">
                          <button type="button" class="botonesgrandes">
                            <i class="fas fa-eye"></i>
                          </button>
                        </a>
                    @endcanany
                    @can('administrador')
                        <a id="eliminaempleado" data-target data-toggle="modal">
                          <button type="button" class="botonesgrandes">
                              <i class="far fa-trash-alt"></i>
                          </button>
                        </a>
                        <!--Incluye los modales por cada accion de eliminar generando sean direfentes los ID -->
                    @endcan
                  </td>
                </tr>
              <!--Fin del foreach-->
         
          </tbody>
        </div>
      </table> 

@include('emplea.registraempleado')
      </div>
    </div>
  </div>
</div>
 
@endsection