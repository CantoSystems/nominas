@extends('layouts.segunda')
@section('content')
<div class="container">
	<div class="row">
		<!-- Inicio Datatables-->
        <div class="col">
        	<div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Departamentos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave departamento</th>
                                <th>Nombre departamento</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departamentos as $dep)
                            <tr>
                                
                                <td>{{$dep->clave_departamento}}</td>
                                <td>{{$dep->departamento}}</td>
                                <td>{{$dep->area}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- Fin Datatables-->

        <!-- Inicio crud-->
        <div class="col">
        	<div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Departamentos</h3>
                </div>
            <div class="card-body">
            <form action="{{route('departamentos.index')}}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="departamento" value="{{$aux->departamento}}" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4">
                            <label>Áreas:</label>

                            <select id="areas" class="custom-select" name="clave_area">

                            <option id="principal" value="{{$aux->clave_area}}">
                                {{$aux->area}}
                            </option>
                             
                				@foreach($areas as $ar)
                						<option value="{{$ar->clave_area}}">{{$ar->area}}</option>
                				@endforeach
              				</select>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                            <input type="hidden" class="form-control" name="clave_departamento" value="{{$aux->clave_departamento}}">
                        </div>
                         <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
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
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-sm-4">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="form-group">
                                 <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="eliminar" data-target="#modal-delete-{{$aux->id}}" data-toggle="modal">
                                        <button type="button" style='width:40px; height:27px'>
                                            <i class="far fa-trash-alt">
                                            </i>
                                        </button></a>
                                </div>
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
                                    <button name="acciones" value="cancelar" id="cancelar" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
                </form>
               @include('departamentos.modaldeletedepartamentos')

        </div>
        <!-- Fin crud-->
        	
	</div>
</div>	
</div>
</div>

@endsection
