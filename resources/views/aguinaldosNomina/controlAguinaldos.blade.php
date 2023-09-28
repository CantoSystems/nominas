@extends('layouts.plantillaAguinaldos')
@section('content')
<div class="container">
    <div class="col" style="padding:0px 0px 0px 0px;">
        <div class="card card-secondary">
            <div class="card-header" style="padding:6px 6px 6px 6px;">
                <h3 class="card-title">
                    Cálculo de Aguinaldos
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="GET" autocomplete="off">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col">
                        @canany(['administrador','capturista'])
                                <label for="validationDefault04"></label>
                                <a data-target="#modalbusquedaempAg" data-toggle="modal">
                                    <button type="submit" id="acciones" name="acciones" value="mostrar" style='width: 65px; height: 38px'>
                                        <i class="far fa-eye"></i>
                                    </button>
                                </a>
                                @include('aguinaldosNomina.modaldespliegue-empleadosAguinaldo')
                        @elsecanany(['reportes'])
                        <button type="button" value="mostrar" style='width: 65px; height: 38px' disabled>
                                        <i class="far fa-eye"></i>
                        </button>
                        @endcan
                            
                        </div>
                        <div class="col">
                        @canany(['administrador','capturista'])
                            <label for="validationDefault04"></label>
                            <button type="submit" id="autorizar" style='width: 125px; height:38px;'>Autorizar Nómina</button>
                        @elsecanany(['reportes'])
                            <button type="button" style='width: 125px; height:38px;' disabled>Autorizar Nómina</button>
                        @endcan   
                        </div>
                        <div class="col">
                        @canany(['administrador','capturista'])
                            <form action="{{ route('aguinaldos.excel3') }}">
                                <button type="submit" style='width:125px; height:38px;'>Descargar Excel</button>
                            </form>
                        @elsecanany(['reportes'])
                            <button type="button" style='width:125px; height:38px;' disabled>Descargar Excel</button>
                        @endcan
                        </div>
                    </div>
                    <br>
                    <div id="divEmp" class="card-header" style="background-color:darkgrey;padding:6px 6px 6px 6px; color:white"></div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-sm-6">
                                <table id="filasPercepciones" name="filasPercepciones" class="table table-hover control">
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
                                    </tbody>
                                </table>
                            </div>
                            <div class = "col-sm-6">
                                <table id="filasImpuestos" name="filasImpuestos" class="table table-hover control">
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
                                                <input type="number" style="text-align: right; font-weight: bold;" step=".01" disabled class="form-control totalPercepTrab">
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
                                                <input type="number" style="text-align: right; font-weight: bold;" step=".01" disabled class="form-control totalImpTrab">
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
                                                <input type="number" style="text-align: right; font-weight: bold;" step=".01" disabled class="form-control totalSueldoNeto">
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