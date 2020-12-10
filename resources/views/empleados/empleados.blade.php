@extends('layouts.segunda')
@section('content')
<div class="container">
  <table class="table table-bordered table-striped" id="example1">
    <thead>
      <tr>
        <th>Clave de Empleado</th>
        <th>Nombre de Empleado</th>
        <th>Puesto</th>
        <th>Departamento</th>
        <th>Área</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($emp))
        @foreach($personal as $emp)
          <tr>
            <th scope="row">{{ $emp->clave_empleado }}</th>
            <td> {{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</td>
            <td>{{$emp->nombre_puesto}}</td>
            <td>{{$emp->departamento}}</td>
            <td>{{$emp->area}}</td>
            <td>
              <button type="button" style='width:70px; height:40px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                <i class="fas fa-eye"></i>
              </button>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table> 
</div>
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
</div>
@include('empleados.modalcrudempleados')
@endsection