@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tiempos Extras Periodo: {{$periodot_extras->fecha_inicio ?? ''}} a {{$periodot_extras->fecha_fin ?? ''}}  </h3>
        </div>

        <form id="agregar_tiempo" autocomplete="off">
            <table class="table table-hover" id="tdinamica_tiempo">
                <thead>
                    <tr>
                        
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <div class="form-group">
                            <!--Campo periodo-->
                        <input  type="text"
                                name="periodo_id[]" 
                                id="periodo" 
                                value="{{$periodot_extras->id ?? ''}}" 
                                class="list-periodo">
                            <!--Campo Clave empleado-->
                            <input  type="text" 
                                    name="clave_empledo[]"
                                    id="clave_empledo" 
                                    maxlength="4" 
                                    class="form-control clave_empledo"
                                    value="" 
                                    onkeyup="mayus(this);">
                            <div class="input-group-append">
                                <span   class="input-group-text">
                                        <i class="fas fa-search">  </i>
                                </span>
                                <div class="listaclave_empleado"></div>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                    </td>


                    <td>
                        <div class="form-group">
                            <input  type="text" 
                                    name="nombre[]"
                                    id="nombre" 
                                    class="form-control nombre_empleado"
                                    value=""
                                    onkeyup="mayus(this);">
                        </div>
                    </td>


                    <td> 
                        <div class="form-group">  
                            <input  type="text" 
                                    name="cantidad_tiempo[]" 
                                    id="cantidad_tiempo"
                                    class="list-cantidad form-control"
                                    onkeyup="mayus(this);"> 
                        </div>
                    </td>



                    <td>   
                        <div class="form-group"> 
                            <input  type="date" 
                                    name="fecha_extra[]" 
                                    id="fecha_extra"
                                    class="list-fecha form-control">
                        </div> 
                    </td>


                    <td>
                        <button name="agregar"  
                                id="agregar">Agregar nuevo</button>
                    </td>

                </tr>
                </tbody>
                
            </table>


            <center>
                    <input  type="button" 
                            name="finalizar" 
                            id="finalizar" 
                            value="Finalizar"
                            style='width:70px; height:40px'>
            </center>

            
        </form>

        
    </div>
</div>
@endsection