@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col">
                 <!-- Inicio Datatables-->
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                       Cálculo de prenomina
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Puesto 
                                    <th>Departamento</th>
                                    <th>Área</th>
                                    <th></th>
                            </tr>
                        </thead>
                        <tbody>
                              @if(!empty($empleados))
                                @foreach($empleados as $emplea)
                                    <tr>
                                        <td scope="row">{{ $emplea->clave_empleado }}</td>
                                        <td>{{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}</td>
                                        <td>{{ $emplea->nombre_puesto }}</td>
                                        <td>{{ $emplea->departamento }}</td>
                                        <td>{{ $emplea->area }}</td>
                                        <td style="width: 20px;">
                                             @can('administrador')
                        <a data-target="#calculo-prenomina{{$emplea->id_emp}}" data-toggle="modal" style='width:70px; height:40px'>
                            <input type="text" name="empleado_prenomina" value="{{$emplea->id_emp}}">
                          <button type="button" style='width:70px; height:40px'>
                              <i class="far fa-eye"></i>
                          </button>
                        </a>
                        <!--Incluye los modales por cada accion de eliminar generando sean direfentes los ID -->
                        @include('prenomina.calculo-prenomina')                
                      </div>
                    @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            
                     
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
