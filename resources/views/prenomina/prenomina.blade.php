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
                        <form action="{{ route('prenomina.index' )}}" method="GET" autocomplete="off">
                            <table id="example1" class="table table-bordered table-striped">
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
                                                <td style="width: 15px; text-align: center;" scope="row">
                                                    {{ $emplea->clave_empleado }}</td>
                                                <td>{{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}</td>
                                                <td>{{ $emplea->departamento }}</td>
                                               
                                                <td style="width: 15px;">
                                                    @can('administrador')
                                                        <a data-target="#calculo-prenomina{{$emplea->id_emp}}" data-toggle="modal" style='width:70px; height:40px'>
                                                            <button type="button"  style='width: 38px; height: 25px'>
                                                                <i class="far fa-eye"></i>
                                                                <input type="hidden" class="identificador_prenomina" value="{{ $emplea->id_emp }}" name="">
                                                            </button>
                                                        </a>
                                                        @include('prenomina.calculo-prenomina')                
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if(empty($empleados))
                            <center>
                                <button type="button"  disabled style='width:125px; height:25px; background-color:red;'>Calcular Nómina</button>
                            </center>
                            @elseif(!empty($empleados))
                            <center>
                                <button type="submit" name="acciones" value="calcular" id="calcular" style='width:125px; height:25px;'>Calcular Nómina</button>
                            </center>
                            @endif
                          
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection