@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Áreas</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Clave Área</th>
                                <th>Área</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($areas as $area)
                            <tr>
                                <td>{{$area->clave_area}}</td>
                                <td>{{$area->area}}</td>
                                <td width="15%" display="align-items:center;">
                                    <div class="form-group">
<<<<<<< HEAD
                                        <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                        
=======
                                        <button type="button" id="actualizar"  data-toggle="modal" data-target="#modalupdatearea" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                        <button type="button" style='width:40px; height:27px; align-items:center;' data-toggle="modal" data-target="#modalcrudempleado">
                                            <i class="far fa-trash-alt"></i>
                                        </button>



>>>>>>> bc06fe33e7599f4b6690b0168fac6fe6fdd6c5a3
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-body">
                        <div display="inline-block" class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                    <button type="button" style='width:40px; height:27px; align-items:center;' data-toggle="modal" data-target="#modaldeletearea">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inicio Crud-->
        <!--<div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Áreas</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('areas.index')}}" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                            <input type="text" name="area" class="form-control" value="{{$aux->area}}"  onkeyup="mayus(this);" onkeypress="return validar(event)">
                            <input type="hidden" name="clave_area" class="form-control" value="{{$aux->clave_area}}"  onkeyup="mayus(this);">
                            <input type="hidden" name="identificador" class="form-control" value="{{$aux->id}}"  onkeyup="mayus(this);">
                            </div>
                        </div>
<<<<<<< HEAD
                    </div>  
                </form>                
            </div>  
=======
                    </div>
                </form>
                @include('areas.modalsearcharea')
            </div>
>>>>>>> bc06fe33e7599f4b6690b0168fac6fe6fdd6c5a3
        </div>-->
    </div>
</div>
@include('areas.modaldeletearea')
<<<<<<< HEAD
@include('areas.modalsearcharea')
@endsection                 
=======
@include('areas.modalupdateareas')
@endsection
>>>>>>> bc06fe33e7599f4b6690b0168fac6fe6fdd6c5a3
