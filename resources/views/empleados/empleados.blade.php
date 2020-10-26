@extends('layouts.segunda')

@section('content')
<div class="container">

 
    <table class="table table-striped" id="example1">
        <thead>
          
          <tr>
            <th scope="col">Clave de Empleado</th>
            <th scope="col">Nombre de Empleado</th>
            <th scope="col">Puesto</th>
            <th scope="col">Departamento</th>
            <th scope="col">Area</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Otto</td>
            <td><button type="button" style='width:70px; height:40px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                <i class="fas fa-eye"></i>
              </button></td>
          </tr>
        </tbody>
      </table> 
</div>

  @include('empleados.modalcrudempleados')
@endsection