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
        @foreach($personal as $emp)
          <tr>
            <td scope="row">{{ $emp->clave_empleado }}</td>
            <td>{{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</td>
            <td>{{ $emp->nombre_puesto }}</td>
            <td>{{ $emp->departamento }}</td>
            <td>{{ $emp->area }}</td>
            <td>

             


            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table> 
</div>

</div>

@if(!empty($emp))
  @include('empleados.modaldeleteempleado')
  
@endif
 @include('empleados.modalcrudinicialempleados')
@endsection
