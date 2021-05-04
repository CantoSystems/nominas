@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Conceptos</h3>
        </div>
        <div class="card-body">
            @if(session()->has('msj'))
                <div class="alert alert-danger" role="alert">
                    {{ session('msj')}}
                </div>
            @endif
            @if(session()->has('busqueda'))
                <div class="alert alert-danger" role="alert">
                    {{ session('busqueda')}}
                </div>
            @endif
            <form action="{{ route('conceptos.index')}}" method="GET" autocomplete="off">
                <div class="row">
                    @if(!empty($aux))
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Clave:</label>
                                <input type="text" name="clave_concepto"  maxlength="3" class="form-control" value="{{$aux->clave_concepto}}" onkeyup="mayus(this)"; >
                            </div>
                            @error('clave_concepto')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Concepto:</label>
                                <input type="text" name="concepto" class="form-control" value="{{$aux->concepto}}" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                <input type="hidden" name="id" class="form-control" value="{{$aux->id}}" onkeyup="mayus(this);">
                            </div>
                            @error('concepto')
                                <div class="alert alert-secondary">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Naturaleza:</label>
                                <select class="custom-select" id="naturaleza" name="naturaleza">
                                    @if($aux->naturaleza=="1")
                                        <option value="1" selected>Selecciona una opción</option>
                                        <option value="P">Percepción</option>
                                        <option value="D">Deducción</option>
                                        <option value="T">Impuesto al trabajador</option>
                                        <option value="I">Impuesto al patrón</option>
                                    @elseif($aux->naturaleza=="P")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="P" selected>Percepción</option>
                                        <option value="D">Deducción</option>
                                        <option value="T">Impuesto al trabajador</option>
                                        <option value="I">Impuesto al patrón</option>
                                    @elseif($aux->naturaleza=="D")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="P">Percepción</option>
                                        <option value="D" selected>Deducción</option>
                                        <option value="T">Impuesto al trabajador</option>
                                        <option value="I">Impuesto al patrón</option>
                                    @elseif($aux->naturaleza=="T")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="P">Percepción</option>
                                        <option value="D">Deducción</option>
                                        <option value="T" selected>Impuesto al trabajador</option>
                                        <option value="I">Impuesto al patrón</option>
                                    @elseif($aux->naturaleza=="I")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="P">Percepción</option>
                                        <option value="D">Deducción</option>
                                        <option value="T">Impuesto al trabajador</option>
                                        <option value="I" selected>Impuesto al patrón</option>
                                    @endif
                                </select>
                                @error('naturaleza')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Manejo:</label>
                                <select class="custom-select" id="manejo" name="manejo">
                                    @if($aux->manejo=="1")
                                        <option value="1" selected>Selecciona una opción</option>
                                        <option value="fijo">Fijo</option>
                                        <option value="variable">Variable</option>
                                    @elseif($aux->manejo=="fijo")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="fijo" selected>Fijo</option>
                                        <option value="variable">Variable</option>
                                    @elseif($aux->manejo=="variable")
                                        <option value="1">Selecciona una opción</option>
                                        <option value="fijo">Fijo</option>
                                        <option value="variable" selected>Variable</option>
                                    @endif
                                </select>
                                 @error('manejo')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <input type="number" name="cantidad" class="form-control" value="{{$aux->cantidad}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Importe:</label>
                                <input type="number" name="importe" class="form-control" value="{{$aux->importe}}" onkeypress="return numeros(event)" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Monto:</label>
                                <input type="number" name="monto" class="form-control" value="{{$aux->monto}}" onkeypress="return numeros(event)" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for=""> Elije el gravado:</label>
                            <div class="form-group">
                                <div class="form-check">
                                    @if($aux->isr==1)
                                        <input class="form-check-input" type="checkbox" name="isr" checked> 
                                    @else
                                        <input class="form-check-input" type="checkbox" name="isr"> 
                                    @endif
                                    <label class="form-check-label">I.S.R</label>
                                </div>
                                <div class="form-check">
                                    @if($aux->imss==1)
                                        <input class="form-check-input" name="imss" type="checkbox" checked>
                                    @else
                                        <input class="form-check-input" name="imss" type="checkbox">
                                    @endif
                                    <label class="form-check-label">I.M.S.S.</label>
                                </div>
                                <div class="form-check">
                                    @if($aux->infonavit==1)
                                        <input class="form-check-input" name="infonavit" type="checkbox" checked>
                                    @else
                                        <input class="form-check-input" name="infonavit" type="checkbox">
                                    @endif
                                    <label class="form-check-label">INFONAVIT</label>
                                </div>
                                <div class="form-check">
                                    @if($aux->estatal==1)
                                        <input class="form-check-input" name="estatal" type="checkbox" checked>
                                    @else
                                        <input class="form-check-input" name="estatal" type="checkbox">
                                    @endif
                                    <label class="form-check-label">IMPUESTO ESTATAL</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>UMA ISR:</label>
                                <input type="number" name="isr_uma" class="form-control" value="{{$aux->isr_uma}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>% ISR:</label>
                                <input type="number" name="isr_porcentaje" class="form-control" value="{{$aux->isr_porcentaje}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>UMA IMMS:</label>
                                <input type="number" name="imss_uma" class="form-control" value="{{$aux->imss_uma}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>% IMMS:</label>
                                <input type="number" name="imss_porcentaje" class="form-control" value="{{$aux->imss_porcentaje}}" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>


                    @else
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Clave:</label>
                                <input type="text" name="clave_concepto"  maxlength="3"  class="form-control" onkeyup="mayus(this);" >
                                @error('clave_concepto')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Concepto:</label>
                                <input type="text" name="concepto" class="form-control" onkeyup="mayus(this);" onkeypress="return validar(event)">
                                @error('concepto')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Naturaleza:</label>
                                <select class="custom-select" id="naturaleza" name="naturaleza">
                                    <option value="1">Selecciona una opción</option>
                                    <option value="P">Percepción</option>
                                    <option value="D">Deducción</option>
                                    <option value="T">Impuesto al trabajador</option>
                                    <option value="I">Impuesto al patrón</option>
                                </select>
                                @error('naturaleza')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                @error('manejo')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <input type="number" name="cantidad" class="form-control" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Importe:</label>
                                <input type="number" name="importe" class="form-control" onkeyup="mayus(this);">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Monto:</label>
                                <input type="number" name="monto" class="form-control" onkeyup="mayus(this);">
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


                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>UMA ISR:</label>
                                <input type="number" name="isr_uma" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>% ISR:</label>
                                <input type="number" name="isr_porcentaje" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>UMA IMMS:</label>
                                <input type="number" name="imss_uma" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>% IMMS:</label>
                                <input type="number" name="imss_porcentaje" class="form-control" value="" onkeyup="mayus(this);" onkeypress="return numeros(event)">
                            </div>
                        </div>

                    @endif
                    <div class="col-md-12">
                        <br>
                    </div>
                    @canany(['administrador','capturista','reportes'])
                        <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                    @if(isset($aux))
                                        <div class="form-group">
                                            <button type="submit"  name="acciones" value="primero" id="primero" class="botonesgrandes"><i class="fas fa-backward" ></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras" class="botonesgrandes"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente" class="botonesgrandes"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo" class="botonesgrandes"><i class="fas fa-forward"></i></button>
                                        </div>
                                    @else
                                    <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-backward" ></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-left"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-arrow-circle-right"></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="botonesgrandes" disabled><i class="fas fa-forward"></i></button>
                                                </div>
                                    @endif

                                    </div>
                                </div>
                        </div>
                    @endcanany
                    <div class="col-sm-5">
                            <div class="margin">
                                <div class="btn-group">
                                    @canany(['administrador','capturista','reportes'])
                                        <div class="form-group">
                                        @if(isset($aux))
                                            <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" class="botonesgrandes">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        @else
                                        <div class="form-group">
                                                        <button id="buscar_falso" type="button" class="botonesgrandes" disabled>
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                        @endif
                                        </div>
                                    @endcanany
                                    @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" class="botonesgrandes"> <i class="fas fa-user-plus"></i></button>
                                        </div>
                                    @if(isset($aux))
                                        <div class="form-group">
                                            <button type="button" id="actualizar" class="botonesgrandes"> <i class="fas fa-pen-square"></i></button>
                                        </div>
                                    @else
                                    <div class="form-group">
                                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                    @endif
                                    @elsecanany(['reportes'])
                                                <div class="form-group">
                                                    <button type="button" disabled class="botonesgrandes"> <i class="fas fa-user-plus"></i></button>
                                                </div>
                                                <div class="form-group">
                                                        <button type="button" class="botonesgrandes" disabled> <i class="fas fa-pen-square"></i></button>
                                                    </div>
                                            @endcanany
                                    @can('administrador')
                                        @if(isset($aux))
                                            <div class="form-group">
                                                <a id="eliminar" data-target="modal-deleteconcepto-{{$aux->id}}" data-toggle="modal">
                                                    <button type="button" class="botonesgrandes">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @else
                                        <div class="form-group">
                                                        <a id="eliminar_vacio">
                                                            <button type="button" disabled class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                        @endif
                                    @elsecanany(['capturista','reportes'])
                                                <div class="form-group">
                                                        <a id="eliminar_">
                                                            <button type="button" disabled class="botonesgrandes">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                            @endcanany
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-2">
                            <div class="margin">
                                <div class="btn-group">
                                    <!--Su uso solo es para visualizar la existencia del los iconos -->
                                            <div class="form-group">
                                                <button id="guardar_falso" disabled class="botonesgrandes"><i class="fas fa-save"></i></button>
                                            </div>
                                    <div class="form-group">
                                        <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;" class="botonesgrandes"><i class="fas fa-save"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <button name="acciones" value="cancelar" id="cancelar_reg" type="submit" class="botonesgrandes" disabled><i class="far fa-window-close"></i></button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </form>
            @if(!empty($aux))
                @include('conceptos.modaldeleteconcetos')
                @include('conceptos.modalsearchconceptos')
            @endif
            
        </div>
    </div>
</div>
</div>


@endsection