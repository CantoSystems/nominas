@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
    <div class="col">
  <table class="table table-bordered table-striped" id="example1">
    <div class="col-sm-12">
    <div class="card-body">
      <div class="margin">
          <div class="btn-group">
              <div class="form-group">
                <button type="button" style='width:70px; height:40px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                  <i class="fas fa-user-plus"></i>
                </button>
              </div>
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
            <td scope="row">{{ $persona->clave_empleado }}  </td>
            <td>{{ $persona->nombre}} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
            <td>{{ $persona->nombre_puesto }}</td>
            <td>{{ $persona->departamento }}</td>
            <td>{{ $persona->area }}   </td>
            <td>
              <div>

             
                <a data-target="#modalmodificaempleado{{$persona->id_emp}}" data-toggle="modal">
                  <button type="button" style='width:70px; height:40px; align-items:center;'  >
                    <i class="fas fa-eye"></i>
                  </button></th>
                </a>
      
                <a id="eliminaempleado" data-target="#modaldeleteempleado{{$persona->id_emp}}" data-toggle="modal" style='width:70px; height:40px'>
                  <button type="button" style='width:70px; height:40px'>
                      <i class="far fa-trash-alt"></i>
                  </button>
                 </a>
                 <!--Incluye los modales por cada accion de eliminar 
                    - generando sean direfentes los ID -->
                        
                        @include('empleados.modaldeleteempleado')
                        @include('empleados.modalmostrarporid')                
              </div>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table> 
</div>

</div>
@include('empleados.modalcrudinicialempleados')
 

@endsection
