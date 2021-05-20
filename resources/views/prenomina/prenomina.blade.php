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
                            <div class="row">
                                <div class="col">
                                    <button type="submit" name="acciones" value="calcular" id="calcular" style='width:125px; height:38px;'>Calcular Nómina</button>
                                </div>
                                <div class="col">
                                    @can('administrador')
                                    <a data-target="#modalbusquedaemp" data-toggle="modal">
                                        <button type="submit" name="acciones" value="mostrar"  style='width: 65px; height: 38px'>
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </a>
                                    @include('prenomina.modalEmpleado')
                              
                                    @endcan
                                </div>
                            </div>
                        <!--Cuerpo de la prenomina-->
                            <br>
                            <div class="card card-secondary">
                                <div class="card-header"><h6 class="card-title">
                                    Empleado: 
                                    @if (isset($prenominaPercepciones))
                                        {{$clave->nombre ?? ''}} {{$clave->apellido_paterno ?? ''}} {{$clave->apellido_materno ?? ''}}
                                    @else
                                        No ha seleccionado ningun empleado
                                    @endif
                                </h6></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class = "col-sm-6">
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="3" style="text-align: center;">Percepciones</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($prenominaPercepciones))
                                                @foreach ($prenominaPercepciones as $percepciones)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" value="{{$percepciones->id_prenomina}}">
                                                        <input type="hidden" value="{{$percepciones->clave_empleado}}">
                                                        {{$percepciones->clave_concepto}}
                                                    <td>
                                                    <td>
                                                        {{$percepciones->concepto}}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$percepciones->monto}}">
                                                    </td>
                                                </tr>
                                                @endforeach 
                                                @else
                                                    
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class = "col-sm-6">
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="3" style="text-align: center;">Deducciones</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($prenominaPercepciones))
                                                @foreach ($prenominaDeducciones as $deducciones)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" value="{{$deducciones->id_prenomina}}">
                                                        <input type="hidden" value="{{$deducciones->clave_empleado}}">
                                                        {{$deducciones->clave_concepto}}
                                                    <td>
                                                    <td>
                                                        {{$deducciones->concepto}}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$deducciones->monto}}">
                                                    </td>
                                                </tr>
                                                @endforeach 
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table table-hover">
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <table class="table table-hover">
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class = "col-sm-6">
                                    </div>
                                    <div class = "col-sm-6">
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="3" style="text-align: center;">Impuestos del Trabajador</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($prenominaPercepciones))
                                                @foreach ($prenominaTrabajador as $trabajador)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" value="{{$trabajador->id_prenomina}}">
                                                        <input type="hidden" value="{{$trabajador->clave_empleado}}">
                                                        {{$trabajador->clave_concepto}}
                                                    <td>
                                                    <td>
                                                        {{$trabajador->concepto}}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$trabajador->monto}}">
                                                    </td>
                                                </tr>
                                                @endforeach 
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                        <table class="table table-hover">
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class = "col-sm-6"></div>
                                    <div class = "col-sm-6">
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="3" style="text-align: center;">Impuestos del Patrón</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <table class="table table-hover">
                                            <tbody>
                                                @if (isset($prenominaPercepciones))
                                                @foreach ($prenominaPatron as $patron)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" value="{{$patron->id_prenomina}}">
                                                        <input type="hidden" value="{{$patron->clave_empleado}}">
                                                        {{$patron->clave_concepto}}
                                                    <td>
                                                    <td>
                                                        {{$patron->concepto}}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$patron->monto}}">
                                                    </td>
                                                </tr>
                                                @endforeach 
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                            </div>
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection