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
<<<<<<< HEAD
            @foreach($personal as $emp)
              <th scope="row">{{ $emp->clave_empleado }}</th>
              
              <td> {{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</td>
              <td>{{$emp->nombre_puesto}}</td>
              <td>{{$emp->departamento}}</td>
              <td>{{$emp->area}}</td>
            @endforeach
=======

            <th scope="row">{{ $emp->clave_empleado }}</th>
            
            <td> {{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</td>
            <td>{{$emp->nombre_puesto}}</td>
            <td>{{$emp->departamento}}</td>
            <td>{{$emp->area}}</td>
             @endforeach
>>>>>>> 86d995c1b8b3588b3968d346376cced9840d3444
            <td><button type="button" style='width:70px; height:40px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                <i class="fas fa-eye"></i>
              </button></td>
          </tr>
<<<<<<< HEAD
        
=======
         
>>>>>>> 86d995c1b8b3588b3968d346376cced9840d3444
        </tbody>
      </table> 
</div>

  @include('empleados.modalcrudempleados')
@endsection