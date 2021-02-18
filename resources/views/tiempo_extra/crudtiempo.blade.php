@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tiempos Extras AJX</h3>
        </div>

        <form id="agregar_tiempo">
            <table class="table table-bordered" id="tdinamica_tiempo">
                <tr>
                    <td>
                        <label>Periodo</label>
                        <input  type="text"
                                name="periodo_id[]" 
                                id="periodo" 
                                class="list-periodo">
                    </td>
                    <td>
                        <label>Clave enpleado</label>
                        <input  type="text" 
                                name="clave_empleado[]" 
                                id="clave_empleado"
                                class="list-clave">
                    </td>
                    <td>   
                        <label>Cantidad</label>
                        <input  type="text" 
                                name="cantidad_tiempo[]" 
                                id="cantidad_tiempo"
                                class="list-cantidad"> 
                    </td>
                    <td>   
                        <label>Fecha</label>
                        <input  type="text" 
                                name="fecha_extra[]" 
                                id="fecha_extra"
                                class="list-fecha"> 
                    </td>
                    <td>
                        <button name="agregar" id="agregar">Agregar nuevo</button>
                    </td>
                </tr>
            </table>
            <center>
                 <input type="button" name="finalizar" id="finalizar" value="Finalizar">
            </center>

            
        </form>

        
    </div>
</div>
@endsection