@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Seleccionar Conceptos
                        </h3>
                    </div>
                    <form action="{{ route('selectConceptos.index')}}" method="GET" autocomplete="off">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Clave Concepto</th>
                                        <th>Concepto</th>
                                        <th>Naturaleza</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($conceptos))
                                        @foreach($conceptos as $concept)
                                            <tr>
                                                <td scope="row">{{ $concept->clave_concepto }}</td>
                                                <td scope="row">{{ $concept->concepto }}</td>
                                                <td scope="row">@if($concept->naturaleza=="P")
                                                                    Percepción
                                                                @elseif($concept->naturaleza=="D")
                                                                    Deducción
                                                                @elseif($concept->naturaleza=="I")
                                                                    Impuesto al trabajador
                                                                @elseif($concept->naturaleza=="T")
                                                                    Impuesto al patrón
                                                                @endif
                                                </td>
                                                <td style="width: 20px;">
                                                    @canany(['administrador','capturista','reportes'])
                                                        <div>
                                                            <center>
                                                                @if($concept->seleccionado==1)
                                                                    <input type="checkbox" id="selectConcepto{{ $concept->id }}" checked name="selectConcepto{{ $concept->id }}" value="{{ $concept->clave_concepto }}">  
                                                                @else
                                                                    <input type="checkbox" id="selectConcepto{{ $concept->id }}" name="selectConcepto{{ $concept->id }}" value="{{ $concept->clave_concepto }}">  
                                                                @endif
                                                            </center>         
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <center>
                                <button name="acciones" value="actualizarConcepto" id="actualizar_reg" type="submit">Guardar</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
