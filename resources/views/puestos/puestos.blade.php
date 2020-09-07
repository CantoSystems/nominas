@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Puestos</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Puesto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($puestos as $puesto)
                            <tr>
                                <td>{{$puesto->clave_puesto}}</td>
                                <td>{{$puesto->nombre_puesto}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
         <!--Fin Datatables-->

         <!--Sección botones y direcciones-->
        
            <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Puestos</h3>
                </div>
            <div class="card-body">
                <form action="{{ route('puestos.index')}}" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Puesto:</label>
                            <input type="text" class="form-control" name="puesto" value="{{$aux->nombre_puesto}}" onkeypress="return validar(event)">
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                            <input type="hidden" class="form-control" name="clave_puesto" value="{{$aux->clave_puesto}}">
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
                                    <a href="#" id="eliminar" data-target="#modal-deletepuesto{{$aux->id}}" data-toggle="modal">
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
                @include('puestos.modaldeletepuesto')
               


        </div>
         <!--Fin botones y direcciones-->
    </div>
</div>

</div>
</div>
 
@endsection