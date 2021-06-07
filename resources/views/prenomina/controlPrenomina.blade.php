@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col" style="padding:0px 0px 0px 0px;">
                <div class="card card-secondary">
                    <div class="card-header" style="padding:6px 6px 6px 6px;">
                        <h3 class="card-title">
                            Cálculo de Prenómina
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET" autocomplete="off">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col">
                                    @can('administrador')
                                        <a data-target="#modalbusquedaemp" data-toggle="modal">
                                            <button type="submit" name="acciones" value="mostrar"  style='width: 65px; height: 38px'>
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>
                                        @include('prenomina.modaldespliegue-empleados')
                                    @endcan
                                </div>
                                <div class="col">
                                    <button type="submit" id="autorizar" style='width:125px; height:38px;'>Autorizar Nómina</button>
                                </div>
                            </div>
                            <!--Cuerpo de la prenomina-->
                            <br>
                                <div class="card-header" style="background-color:darkgrey;padding:6px 6px 6px 6px; color:white">
                                    <h6 class="card-title">
                                        Empleado: 
                                        @if(isset($prenominaPercepciones))
                                            {{$clave->nombre ?? ''}} {{$clave->apellido_paterno ?? ''}} {{$clave->apellido_materno ?? ''}}
                                        @else
                                            No ha seleccionado ningun empleado
                                        @endif
                                    </h6>
                                </div>
                            <div class="card-body">
                            @if(isset($prenominaPercepciones))
                                @if(isset($status_prenomina->status_prenomina) == 0)
                                <div class="alert alert-light" role="alert">
                                  Nómina sin verificar
                                </div>
                                @else
                                <div class="alert alert-success" role="alert">
                                  Nómina Verificada
                                </div>
                                @endif
                            @else

                                
                            @endif
                                <div class="row" >
                                    <div class="col-sm-6">
                                        <table class="table table-hover prueba">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="4" style="text-align: center;">Percepciones</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col"  colspan="2" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($prenominaPercepciones))
                                                    @foreach ($prenominaPercepciones as $percepciones)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="idPrenomina" value="{{ $percepciones->id_prenomina }}">
                                                                <input type="hidden" class="clvCncpt" value="{{ $percepciones->clave_concepto }}">
                                                                {{$percepciones->clave_concepto}}
                                                            <td>
                                                            <td>
                                                                {{$percepciones->concepto}}
                                                            </td>
                                                            <td>
                                                                <input type="number" step=".01" class="form-control monto totales" value="{{ $percepciones->monto }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach 
                                                @else
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class = "col-sm-6">
                                        <table class="table table-hover prueba">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" colspan="4" style="text-align: center;">Deducciones</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" style="text-align: center;">Clave</th>
                                                    <th scope="col" colspan="2" style="text-align: center;">Concepto</th>
                                                    <th scope="col" style="text-align: center;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($prenominaPercepciones))
                                                    @foreach($prenominaDeducciones as $deducciones)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="idPrenomina" value="{{ $deducciones->id_prenomina }}">
                                                                <input type="hidden" class="clvCncpt" value="{{ $deducciones->clave_concepto }}">
                                                                {{ $deducciones->clave_concepto }}
                                                            <td>
                                                            <td>
                                                                {{ $deducciones->concepto }}
                                                            </td>
                                                            <td>
                                                                <input type="number" step=".01" class="form-control monto totales2" value="{{ $deducciones->monto }}">
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
                                                <tr>
                                                    <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                                    <td style="width: 42%;">
                                                        <input type="number" step=".01" disabled class="form-control totalPercepciones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                                    <td style="width: 42%;">
                                                        <input type="number" step=".01" disabled class="form-control totalDeducciones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class = "col-sm-6"></div>
                                    <div class = "col-sm-6">
                                        <table class="table table-hover prueba">
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
                                                @if(isset($prenominaPercepciones))
                                                    @foreach ($prenominaTrabajador as $trabajador)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="idPrenomina" value="{{ $trabajador->id_prenomina }}">
                                                                <input type="hidden" class="totales" value="{{ $trabajador->clave_empleado }}">
                                                                <input type="hidden" class="clvCncpt" value="{{ $trabajador->clave_concepto }}">
                                                                {{ $trabajador->clave_concepto }}
                                                            <td>
                                                            <td>
                                                                {{ $trabajador->concepto }}
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control monto" value="{{ $trabajador->monto }}">
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
                                                @if(isset($prenominaPercepciones))
                                                    @foreach($prenominaPatron as $patron)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="idPrenomina" value="{{ $patron->id_prenomina }}">
                                                                <input type="hidden" value="{{ $patron->clave_empleado }}">
                                                                <input type="hidden" class="clvCncpt" value="{{ $patron->clave_concepto }}">
                                                                {{ $patron->clave_concepto }}
                                                            <td>
                                                            <td>
                                                                {{ $patron->concepto }}
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control monto" value="{{ $patron->monto }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach 
                                                @else
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
    </div>
</div>
@endsection