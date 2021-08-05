@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Préstamos
                        </h3>
                    </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 15px; text-align: center;">No. Préstamo</th>
                                <th>Empleado</th>
                                <th style="width: 30px; text-align: center;">No. Pagos</th>
                                <th style="width: 20px; text-align: center;">Importe</th>
                                <th style="width: 35px; text-align: center;">Monto</th>
                                <th style="width: 60px; text-align: center;">Fecha de Solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($prestamos))
                                @foreach($prestamos as $datos)
                                    <tr>
                                        <th style="text-align: center;">{{ $datos->idPrestamo }}</th>
                                        <th>{{ $datos->nombre }} {{ $datos->apellido_paterno }} {{ $datos->apellido_materno }}</th>
                                        <th style="text-align: center;">{{ $datos->cantidad }}</th>
                                        <th style="text-align: center;">$ {{ number_format($datos->importe,2) }}</th>
                                        <th style="text-align: center;">$ {{ number_format($datos->monto,2) }}</th>
                                        <th style="text-align: center;">{{ substr($datos->created_at,0,10) }}</th>
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
</div>
@endsection