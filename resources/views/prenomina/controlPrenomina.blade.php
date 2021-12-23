@extends('layouts.plantillaPrenomina')
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
                                    <button type="submit" name="acciones" value="mostrar" style='width: 65px; height: 38px'>
                                        <i class="far fa-eye"></i>
                                    </button>
                                </a>
                                @include('prenomina.modaldespliegue-empleados')
                            @endcan
                        </div>
                        <div class="col">
                            <button type="submit" id="autorizar" style='width:125px; height:38px;'>Autorizar Nómina</button>
                        </div>
                        <div class="col">
                            <form action="{{ route('control.excel3') }}">
                                <button type="submit" style='width:125px; height:38px;'>Descargar Excel</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="">
                                <button>Desactivar y crear nuevo periodo</button>
                            </form>

                        </div>
                    </div>
                    <br>
                    <div class="card-header" style="background-color:darkgrey; padding:6px 6px 6px 6px; color: white;">
                        <h6 class="card-title">
                            <b>Empleado: </b>
                            @if(isset($portipopercepciones))
                                {{$clave->nombre ?? ''}} {{$clave->apellido_paterno ?? ''}} {{$clave->apellido_materno ?? ''}}
                                <input type="hidden" id="extraerEmp" value="{{ $clave->clave_empleado}}">
                            @else
                                No ha seleccionado ningun empleado
                            @endif
                            @if(session()->has('uma'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('uma')}}
                            </div>
                        @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-sm-6">
                                <table id="filasPercepciones" name="filasPercepciones" class="table table-hover control">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" colspan="4" style="text-align: center;">Percepciones</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="text-align: center;">Clave</th>
                                            <th scope="col" colspan="2" style="text-align: center;">Concepto</th>
                                            <th scope="col" style="text-align: center;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($portipopercepciones))
                                            @foreach ($portipopercepciones as $percepciones)
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <input type="hidden" class="clvEmp" value="{{ $percepciones['clave_empleado'] }}">
                                                        {{ $percepciones['clave_concepto'] }}
                                                    <td>
                                                    <td>
                                                        <input type="hidden" class="clvCncpt" value="{{ $percepciones['clave_concepto'] }}">
                                                        {{$percepciones['concepto'] }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input type="hidden" step=".01" class="monto totales" value="{{ $percepciones['monto'] ?? 0 }}">
                                                        <input type="hidden" step=".01" class="gravable percepGrav" value="{{ $percepciones['gravable'] ?? 0}}">
                                                        <input type="hidden" step=".01" class="excento percepExcentas" value="{{ $percepciones['excento'] ?? 0}}">
                                                        $ {{ number_format($percepciones['monto'],2) ?? 0}}
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class = "col-sm-6">
                                <table id="filasDeducciones" name="filasDeducciones" class="table table-hover control" >
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
                                        @if(isset($portipodeducciones))
                                            @foreach($portipodeducciones as $deducciones)
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <input type="hidden" class="clvEmp" value="{{ $deducciones['clave_empleado'] }}">
                                                        {{ $deducciones['clave_concepto'] }}
                                                    <td>
                                                    <td>
                                                        <input type="hidden" class="clvCncpt" value="{{ $deducciones['clave_concepto'] }}">
                                                        {{ $deducciones['concepto'] }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input type="hidden" step=".01" class="form-control monto totales2" value="{{ $deducciones['monto'] }}">
                                                        <input type="hidden" step=".01" class="gravable" value="0">
                                                        <input type="hidden" step=".01" class="excento" value="0">
                                                        $ {{ number_format($deducciones['monto'],2) }}
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
                                <table class="table table-hover control" >
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                            <td style="width: 42%;">
                                                <input type="hidden" class="form-control conceptoPercepciones clvCncpt">
                                                <input type="hidden" class="clvEmp" value="{{ $clave->clave_empleado ?? ''}}">
                                                <input type="number" step=".01" disabled class="form-control monto totalPercepciones">
                                                <input type="hidden" step=".01" class="totalPercepcionesGravadas">
                                                <input type="hidden" step=".01" class="totalPercepcionesExcentas">
                                                <input type="hidden" step=".01" class="totalPercepcionesIMSS" value="{{ $sumaImss ?? '' }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-hover control">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                            <td style="width: 42%;">
                                                <input type="hidden" class="clvEmp" value="{{ $clave->clave_empleado ?? ''}}">
                                                <input type="hidden" class="form-control clvCncpt conceptodeducciones">
                                                <input type="number" step=".01" disabled class="form-control monto totalDeducciones">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class = "col-sm-6">
                                <table id="filasPatron" name="filasPatron" class="table table-hover control" >
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
                            </div>
                            <div class = "col-sm-6">
                                <table id="filasImpuestos" name="filasImpuestos" class="table table-hover control" >
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" colspan="3" style="text-align: center;">Impuestos del Trabajador</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="text-align: center;">Clave </th>
                                            <th scope="col" style="text-align: center;">Concepto</th>
                                            <th scope="col" style="text-align: center;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-hover control" >
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                            <td style="width: 42%;">
                                                <input type="hidden" class="form-control clvCncpt conceptoPatron">
                                                <input type="hidden" class="clvEmp" value="{{ $clave->clave_empleado ?? ''}}">
                                                <input type="number" step=".01" disabled class="form-control monto totalImpuestosPatron">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-hover control" >
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                            <td style="width: 42%;">
                                                <input type="hidden" class="form-control clvCncpt conceptoTrabajador">
                                                <input type="hidden" class="clvEmp" value="{{ $clave->clave_empleado ?? ''}}">
                                                <input type="number" step=".01" disabled class="form-control monto totalImpuestosTrabajador">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class = "col-sm-6"></div>
                            <div class = "col-sm-6">
                                <table id="filasTotales" name="filasTotales" class="table table-hover control">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" colspan="3" style="text-align: center;">Totales</th>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right; valign: middle;">Total: </td>
                                            <td style="width: 42%;">
                                                <input disabled class="form-control inpTotalNeto">
                                            </td>
                                        </tr>
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