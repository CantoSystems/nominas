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
                            Cálculo de Prenómina
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <thead>
                                <tr>
                                    <th style="width: 15px; text-align: center;">Clave</th>
                                    <th>Empleado</th>
                                    <th>Departamento</th>
                                    <th style="text-align: center;">Total Percepciones</th>
                                    <th style="text-align: center;">Total Deducciones</th>
                                    <th style="text-align: center;">Pago Neto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($empleados))
                                    @foreach($empleados as $emplea)
                                        <tr>
                                            <td style="width: 15px; text-align: center;" scope="row">{{ $emplea->clave_empleado }}</td>
                                            <td>{{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}</td>
                                            <td>{{ $emplea->departamento }}</td>
                                            <td style="text-align: center;">$7,500.00</td>
                                            <td style="text-align: center;">$7,500.00</td>
                                            <td style="text-align: center;">$7,500.00</td>
                                            <td style="width: 15px;">
                                                @can('administrador')
                                                    <a data-target="#calculo-prenomina{{$emplea->id_emp}}" data-toggle="modal" style='width:70px; height:40px'>
                                                        <button type="button" class="extraer_id" style='width: 38px; height: 25px'>
                                                            <i class="far fa-eye"></i>
                                                            <input type="hidden" class="identificador_prenomina" value="{{ $emplea->id_emp }}" name="">
                                                        </button>
                                                    </a>
                                                    <!--Incluye los modales por cada accion de eliminar generando sean diferentes los ID -->
                                                    @include('prenomina.calculo-prenomina')                
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