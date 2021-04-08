@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                       Nómina Normal 
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Sueldo</th>
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
                                            @canany(['administrador','capturista','reportes'])
                                                <div>
                                                    <center>
                                                        <a href="{{ route('reportnomina.mostrar',$emplea->id_emp) }}">
                                                            <button type="button" class="botonesgrandes">
                                                                <i class="far fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </center>         
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
