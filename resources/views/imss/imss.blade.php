@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabla IMSS</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('imss.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(isset($imss))
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Seguro y concepto:</label>
                                        <select id="seguroIMSS" name="seguroIMSS" class="custom-select">
                                            @if($imss->concepto=="N/A" || $imss->concepto==null)
                                                <option selected value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Riesgos de Trabajo")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option selected value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Enfermedades y Maternidad")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option selected value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Invalidez y Vida")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option selected value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option selected value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Guarderías y Prestaciones Sociales")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option selected value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option value="Infonavit">Infonavit</option>
                                            @elseif($imss->concepto=="Infonavit")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                                <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                                <option value="Invalidez y Vida">Invalidez y Vida</option>
                                                <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                                <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                                <option selected value="Infonavit">Infonavit</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Prestaciones:</label>
                                        <select id="prestacionIMSS" name="prestacionIMSS" class="custom-select">
                                            @if($imss->prestaciones=="N/A" || $imss->prestaciones==null)
                                                <option selected value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="En especie y dinero")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option selected value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="En especie")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option selected value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="Gastos médicos para pensionados y beneficiarios")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option selected value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="En dinero")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option selected value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="Retiro")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option selected value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="CEAV")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option selected value="CEAV">CEAV</option>
                                                <option value="Crédito para vivienda">Crédito para vivienda</option>
                                            @elseif($imss->prestaciones=="Crédito para vivienda")
                                                <option value="N/A">Selecciona una opción...</option>
                                                <option value="En especie y dinero">En especie y dinero</option>
                                                <option value="En especie">En especie</option>
                                                <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                                <option value="En dinero">En dinero</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="CEAV">CEAV</option>
                                                <option selected value="Crédito para vivienda">Crédito para vivienda</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Cuota (Patrón):</label>
                                        <input type="hidden" name="id_imss" value="{{ $imss->id_imss }}">
                                        <input type="number" name="cuotapatron" value="{{ $imss->cuotapatron1 }}" class="form-control" step="0.01" >
                                    </div>
                                </div>
                                @if($imss->cuotapatron2!=null)
                                    <div id="divcuotapatron2" class="col-sm-4">
                                        <div class="form-group">
                                            <label>2da Cuota (Patrón):</label>
                                            <input type="number" name="cuotapatron2" value="{{ $imss->cuotapatron2 }}" class="form-control" step="0.01" >
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>2da Cuota (Patrón):</label>
                                        <input type="number" name="cuotapatron2" value="{{ $imss->cuotapatron2 }}" class="form-control" step="0.01" >
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Base Salarial:</label>
                                        @if($imss->base == 'SBC')
                                        <select class="custom-select" name="basesalarial">
                                            <option value="">Selecciona una opción</option>
                                            <option value="{{ $imss->base }}">{{ $imss->base }}</option>
                                             <option value="UMA">UMA</option>
                                        </select>
                                        @else
                                        <select class="custom-select" name="basesalarial">
                                            <option value="">Selecciona una opción</option>
                                            <option value="{{ $imss->base }}">{{ $imss->base }}</option>
                                             <option value="SBC">SBC</option>
                                        </select>
                                        @endif

                                        
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Seguro y concepto:</label>
                                        <select id="seguroIMSS" name="seguroIMSS" class="custom-select">
                                            <option value="N/A">Selecciona una opción...</option>
                                            <option value="Riesgos de Trabajo">Riesgos de Trabajo</option>
                                            <option value="Enfermedades y Maternidad">Enfermedades y Maternidad</option>
                                            <option value="Invalidez y Vida">Invalidez y Vida</option>
                                            <option value="Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)">Retiro, Cesantía en Edad Avanzada y Vejez (CEAV)</option>
                                            <option value="Guarderías y Prestaciones Sociales">Guarderías y Prestaciones Sociales</option>
                                            <option value="Infonavit">Infonavit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Prestaciones:</label>
                                        <select id="prestacionIMSS" name="prestacionIMSS" class="custom-select">
                                            <option value="N/A">Selecciona una opción...</option>
                                            <option value="En especie y dinero">En especie y dinero</option>
                                            <option value="En especie">En especie</option>
                                            <option value="Gastos médicos para pensionados y beneficiarios">Gastos médicos para pensionados y beneficiarios</option>
                                            <option value="En dinero">En dinero</option>
                                            <option value="Retiro">Retiro</option>
                                            <option value="CEAV">CEAV</option>
                                            <option value="Crédito para vivienda">Crédito para vivienda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Cuota (Patrón):</label>
                                        <input type="number" name="cuotapatron" class="form-control" step="0.01" >
                                    </div>
                                </div>
                                <div id="divcuotapatron2" class="col-sm-4">
                                    <div class="form-group">
                                        <label>2da Cuota (Patrón):</label>
                                        <input type="number" name="cuotapatron2" class="form-control" step="0.01" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Cuota (Trabajador):</label>
                                        <input type="number" name="cuotatrabajador" class="form-control" step="0.01">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Base Salarial:</label>
                                    <select class="custom-select" name="basesalarial">
                                        <option value="">Selecciona una opción</option>
                                        <option value="SBC">SBC</option>
                                        <option value="UMA">UMA</option>
                                    </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            @canany(['administrador','capturista','reportes'])
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                @isset($imsss)
                                                    <div class="form-group">
                                                        <button type="submit"  name="acciones" value="primero" id="primero" style='width:40px; height:27px'><i class="fas fa-backward" ></i></button>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="acciones" value="atras" id="atras" style='width:40px; height:27px'><i class="fas fa-arrow-circle-left"></i></button>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:40px; height:27px'><i class="fas fa-arrow-circle-right"></i></button>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:40px; height:27px'><i class="fas fa-forward"></i></button>
                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcanany
                            <div class="col-sm-4">
                                <div class="card-body">
                                    <div class="margin">
                                        @canany(['administrador','capturista','reportes'])
                                            <div class="btn-group">
                                                <div class="form-group">
                                                    @isset($imsss)
                                                        <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    @endisset
                                                </div>
                                                @endcanany
                                                @canany(['administrador','capturista'])
                                                    <div class="form-group">
                                                        <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                                    </div>
                                                    @isset($imsss)
                                                        <div class="form-group">
                                                            <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                                        </div>
                                                    @endisset
                                                @endcanany
                                                @can('administrador')
                                                    @if(!empty($ims))
                                                        @isset($imsss)
                                                            <div class="form-group">
                                                                <a id="eliminar" data-target="#modal-deleteimsss-{{$ims->id_imss}}" data-toggle="modal">
                                                                    <button type="button" style='width:40px; height:27px'>
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @endisset
                                                    @endif
                                                @endcan
                                            </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-3">
                                    <div class="card-body">
                                        <div class="margin">
                                            <div class="btn-group">
                                                <div class="form-group">
                                                    <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($ims))
  @include('imss.modaldeleteimss')
  @include('imss.modalsearchimss')
@endif

@endsection