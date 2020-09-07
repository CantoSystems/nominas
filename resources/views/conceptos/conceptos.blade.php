@extends('layouts.segunda')

@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Conceptos</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('conceptos.index')}}" method="GET">
    		<div class="row">
    			<div class="col-sm-1">
                    <div class="form-group">
                        <label>Clave:</label>
                        <input type="text" name="clave_concepto"  class="form-control" value="{{$aux->clave_concepto}}" onkeyup="mayus(this)"; >
                    </div>
                </div>    
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Concepto:</label>
                        <input type="text" name="concepto" class="form-control" value="{{$aux->concepto}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Naturaleza:</label>
                        <select class="custom-select" name="naturaleza">
                        <option value="{{$aux->naturaleza}}">{{$aux->naturaleza}}</option>
                            <option value="P">Persepcion</option>
                            <option value="D">Deducción</option>
                            <option value="I">Impuesto al trabajador</option>
                            <option value="C">Impuesto al patron</option>
                          </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Manejo:</label>
                        <select class="custom-select" name="manejo">
                            <option value="{{$aux->manejo}}">{{$aux->manejo}}</option>
                                <option value="fijo">FIJO</option>
                                <option value="variable">VARIABLE</option>
                              </select>
                    </div>  
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Fórmula:</label>
                        <input type="text" name="formula" class="form-control" value="{{$aux->formula}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" name="formula" class="form-control" value="{{$aux->cantidad}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Importe:</label>
                        <input type="text" name="formula" class="form-control" value="{{$aux->importe}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Monto:</label>
                        <input type="text" name="formula" class="form-control" value="{{$aux->monto}}" onkeyup="mayus(this);">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- checkbox -->
                    <label for=""></label>
                    <div class="form-group">
                      <div class="form-check">
                      <input type="checkbox" name="ispt" id="ispt" value="{{$aux->ispt}}" {{  ($aux->ispt == 1 ? ' checked' : '') }}>
                        <label class="form-check-label">I.S.P.T.</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$aux->imss}}"@if ($aux->imss==1)
                        checked                          
                       @endif>
                        <label class="form-check-label">I.M.S.S.</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$aux->infonavit}}"@if ($aux->infonavit==1)
                        checked                          
                       @endif>
                        <label class="form-check-label">INFONAVIT</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$aux->estatal}}"@if ($aux->estatal==1)
                        checked                          
                       @endif>
                        <label class="form-check-label">ESTATAL</label>
                      </div>
                    </div>
                  </div> 
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


                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="form-group">
                                 <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="eliminar" data-target="#modal-deletenom-" data-toggle="modal" style='width:70px; height:40px'>
                                        <button type="button" style='width:70px; height:40px'>
                                            <i class="far fa-trash-alt">
                                            </i>
                                        </button></a>
                                </div>
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
                                <div class="form-group">
                                    <button name="acciones" value="cancelar_actualiza" id="cancelar_actualiza" type="submit" style="display: none;width:70px; height:40px"><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
    	</form>	
   	</div> 	
</div>	


@endsection