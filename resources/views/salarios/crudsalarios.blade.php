@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabla Salario Mínimo</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('salariomin.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            @if(isset($salMinimo))
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Fecha de Inicio</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="date" id="fechaInicioSal" name="fechaInicioSal"
                                        value="{{ $salMinimo->fechaInicio }}" class="form-control">
                                    <input type="hidden" id="idsalMinimo" name="idsalMinimo"
                                        value="{{ $salMinimo->idSalarioMinimo }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Fecha de Término</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="date" id="fechaTerminoSal" name="fechaTerminoSal"
                                        value="{{ $salMinimo->fechafin }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Área Geográfica</label>
                                    <strong class="obligatorio">*</strong>
                                    <select id="regionSalario" name="regionSalario" class="custom-select">
                                        @if($salMinimo->region=="N/A")
                                        <option selected value="N/A">Selecciona una opción</option>
                                        <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                        <option value="Resto">Resto del país</option>
                                        @elseif($salMinimo->region=="Frontera")
                                        <option value="N/A">Selecciona una opción</option>
                                        <option selected value="Frontera">Zona Libre de la Frontera Norte</option>
                                        <option value="Resto">Resto del país</option>
                                        @elseif($salMinimo->region=="Resto")
                                        <option value="N/A">Selecciona una opción</option>
                                        <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                        <option selected value="Resto">Resto del país</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Monto Vigente</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" id="importeSal" name="importeSal" step="0.01"
                                        value="{{ $salMinimo->importe }}" class="form-control">
                                </div>
                            </div>
                            @else
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Fecha de Inicio</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="date" id="fechaInicioSal" name="fechaInicioSal" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Fecha de Término</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="date" id="fechaTerminoSal" name="fechaTerminoSal" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Área Geográfica</label>
                                    <strong class="obligatorio">*</strong>
                                    <select id="regionSalario" name="regionSalario" class="custom-select">
                                        <option value="N/A">Selecciona una opción</option>
                                        <option value="Frontera">Zona Libre de la Frontera Norte</option>
                                        <option selected value="Resto">Resto del país</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="titulo">Monto Vigente</label>
                                    <strong class="obligatorio">*</strong>
                                    <input type="number" id="importeSal" name="importeSal" step="0.01"
                                        class="form-control">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($salMinimo))
                                        <div class="form-group">
                                            <button type="submit" name="acciones" title="Primero" value="primero" id="primero"
                                                class="botonesgrandes"><i class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" title="Atrás" value="atras" id="atras"
                                                class="botonesgrandes"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" title="Siguiente" value="siguiente" id="siguiente"
                                                class="botonesgrandes"><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones"  title="Siguiente" value="ultimo" id="ultimo"
                                                class="botonesgrandes"><i class="fas fa-forward"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="submit"  title="Primero" class="botonesgrandes" disabled><i
                                                    class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"  title="Atrás" class="botonesgrandes" disabled><i
                                                    class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" title="Siguiente" class="botonesgrandes" disabled><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" title="Último" class="botonesgrandes" disabled><i
                                                    class="fas fa-forward"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endcanany

                            <div class="col-md-5">
                                <div class="margin">
                                    @canany(['administrador','capturista','reportes'])
                                    <div class="btn-group">
                                        <div class="form-group">
                                            @if(isset($salMinimo))
                                            <button id="buscar" type="button" title="Buscar" data-toggle="modal"
                                                data-target="#modalBusqSal" class="botonesgrandes">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @else
                                            <div class="form-group">
                                                <button id="buscar_falso" title="Buscar" type="button" class="botonesgrandes" disabled>
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                        @endcanany
                                        @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" title="Agregar" id="nuevo" class="botonesgrandes"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        @if(isset($salMinimo))
                                        <div class="form-group">
                                            <button type="button" title="Actualizar" id="actualizar" class="botonesgrandes"> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" title="Actualizar" class="botonesgrandes" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                        @elsecanany(['reportes'])
                                        <div class="form-group">
                                            <button type="button" title="Agregar" disabled class="botonesgrandes"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" title="Actualizar" class="botonesgrandes" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endcanany
                                        @can('administrador')
                                        @if(isset($salMinimo))
                                        <div class="form-group">
                                            <a id="eliminar"
                                                data-target="#modal-deleteSalario-{{$salMinimo->idSalarioMinimo}}"
                                                data-toggle="modal">
                                                <button type="button" title="Eliminar" class="botonesgrandes">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" title="Eliminar" disabled class="botonesgrandes">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                        @elsecanany(['capturista','reportes'])
                                        <div class="form-group">
                                            <a id="eliminar_">
                                                <button type="button" title="Eliminar" disabled class="botonesgrandes">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="margin">
                                    <div class="btn-group">
                                        <!--Su uso solo es para visualizar la existencia del los iconos -->
                                        <div class="form-group">
                                            <button id="guardar_falso" title="Guardar" disabled class="botonesgrandes"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button id="nuevo_reg" title="Guardar" name="acciones" value="registrar" type="submit"
                                                style="display: none;" class="botonesgrandes"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" title="Guardar" value="actualizar" id="actualizar_reg" type="submit"
                                                style="display: none;" class="botonesgrandes"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" title="Cancelar" value="cancelar" id="cancelar_reg" type="submit"
                                                class="botonesgrandes" disabled><i
                                                    class="far fa-window-close"></i></button>
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
@include('salarios.modalbusquedasalario')
@if(isset($salMinimo))
@include('salarios.modaldeletesalario')
@endif
@endsection