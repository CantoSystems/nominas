@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Prestaciones</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Año</th>
                                <th>Días</th>
                                <th>Prima Vacacional</th>
                                <th>Aguinaldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestaciones as $presta)
                            <tr>
                                <td>{{$presta->anio}}</td>
                                <td>{{$presta->dias}}</td>
                                <td>{{$presta->prima_vacacional}}</td>
                                <td>{{$presta->aguinaldo}}</td>
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
                    <h3 class="card-title">Prestaciones</h3>
                </div>
            <div class="card-body">
                <form action="{{ route('prestaciones.index')}}" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Año</label>
                            <input type="hidden" class="form-control" name="identificador" value="{{$aux->id}}">
                            <input type="text" class="form-control" name="anio"
                            value="{{$aux->anio}}">
                        </div>
                        <div class="col-md-6">
                            <label>Días</label>
                            <input type="text" class="form-control" name="dias" value="{{$aux->dias}}">
                        </div>
                        <div class="col-md-6">
                            <label>Prima Vacacional</label>
                            <input type="text" class="form-control" name="prima_vacacional" value="{{$aux->prima_vacacional}}">
                        </div>
                        <div class="col-md-6">
                            <label>Aguinaldo</label>
                            <input type="text" class="form-control" name="aguinaldo" value="{{$aux->aguinaldo}}">
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
                                    <button type="button" id="nuevo_periodos" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="form-group">
                                 <button type="button" id="actualizar_periodos" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="eliminar" data-target="#modal-deletenom" data-toggle="modal">
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
                                    <button name="acciones" value="cancelar_periodos" id="cancelar_periodos" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
                </form>
               

        </div>
         <!--Fin botones y direcciones-->
    </div>
</div>

</div>
</div>

@endsection