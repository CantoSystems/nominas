@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Conceptos</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('conceptos.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    @if(!empty($aux))
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Clave:</label>
                                <input type="text" name="clave_concepto" class="form-control" value="{{$aux->clave_concepto}}" onkeyup="mayus(this)"; >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Concepto:</label>
                                <input type="text" name="concepto" class="form-control" value="{{$aux->concepto}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                <input type="hidden" name="id" class="form-control" value="{{$aux->id}}" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Naturaleza:</label>
                                <select class="custom-select" id="naturaleza" name="naturaleza">
                                <option value="{{$aux->naturaleza}}">{{$aux->naturaleza}}</option>
                                    <option value="1">Selecciona una opción</option>
                                    <option value="P">Percepcion</option>
                                    <option value="D">Deducción</option>
                                    <option value="T">Impuesto al trabajador</option>
                                    <option value="I">Impuesto al patron</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Manejo:</label>
                                <select class="custom-select" id="manejo" name="manejo">
                                    <option value="{{$aux->manejo}}">{{$aux->manejo}}</option>
                                    <option value="1">Selecciona una opción</option>
                                    <option value="fijo">FIJO</option>
                                    <option value="variable">VARIABLE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Fórmula:</label>
                                <input type="text" name="formula" class="form-control" value="{{$aux->formula}}" onkeyup="mayus(this);" >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Cantidad:</label>
                                <input type="text" name="cantidad" class="form-control" value="{{$aux->cantidad}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Importe:</label>
                                <input type="text" name="importe" class="form-control" value="{{$aux->importe}}" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Monto:</label>
                                <input type="text" name="monto" class="form-control" value="{{$aux->monto}}" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for=""> Elije el gravado:</label>
                            <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="isr" value="{{$aux->ispt}}">
                                <label class="form-check-label">I.S.R</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="imss" type="checkbox" value="{{$aux->imss}}">
                                <label class="form-check-label">I.M.S.S.</label>
                            </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="infonavit" type="checkbox" value="{{$aux->infonavit}}">
                                    <label class="form-check-label">INFONAVIT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="estatal" type="checkbox" value="{{$aux->estatal}}">
                                    <label class="form-check-label">IMPUESTO ESTATAL</label>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Clave:</label>
                                <input type="text" name="clave_concepto" class="form-control" onkeyup="mayus(this);" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Concepto:</label>
                                <input type="text" name="concepto" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Naturaleza:</label>
                                <select class="custom-select" id="naturaleza" name="naturaleza">
                                    <option value="1">Selecciona una opción</option>
                                    <option value="P">Percepcion</option>
                                    <option value="D">Deducción</option>
                                    <option value="T">Impuesto al trabajador</option>
                                    <option value="I">Impuesto al patron</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Manejo:</label>
                                <select class="custom-select" id="manejo" name="manejo">
                                    <option value="1">Selecciona una opción</option>
                                    <option value="fijo">Fijo</option>
                                    <option value="variable">Variable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Fórmula:</label>
                                <input type="text" name="formula" class="form-control" onkeyup="mayus(this);" >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Cantidad:</label>
                                <input type="text" name="cantidad" class="form-control" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Importe:</label>
                                <input type="text" name="importe" class="form-control" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Monto:</label>
                                <input type="text" name="monto" class="form-control" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for=""> Elije el gravado:</label>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="isr">
                                    <label class="form-check-label">I.S.R</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="imss" type="checkbox">
                                    <label class="form-check-label">I.M.S.S.</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="infonavit" type="checkbox">
                                    <label class="form-check-label">INFONAVIT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="estatal" type="checkbox">
                                    <label class="form-check-label">IMPUESTO ESTATAL</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-sm-5">
                            <div class="card-body">
                                <div class="margin">
                                    <div class="btn-group">
                                        <div class="form-group">
                                            <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcanany
                    <div class="col-sm-5">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    @canany(['administrador','capturista','reportes'])
                                        <div class="form-group">
                                            <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:70px; height:40px'>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                        </div>
                                    @endcanany
                                    @can('administrador')
                                        @if(!empty($aux))
                                            <div class="form-group">
                                                <a id="eliminar" data-target="#modal-deleteconcepto-{{$aux->id}}" data-toggle="modal" style='width:70px; height:40px'>
                                                    <button type="button" style='width:70px; height:40px'>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card-body">
                            <div class="margin">
                                <div class="btn-group">
                                    <div class="form-group">
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if(!empty($aux))
                @include('conceptos.modaldeleteconcetos')
            @endif
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
