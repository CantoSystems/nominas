@if(!empty($aux1))
    <div class="modal fade" id="modal-searchemp-{{ $aux1->clave_concepto }}">
@else
    <div class="modal fade" id="modal-searchemp">
@endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buscar Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--<form action="{{ route('incidencias.index')}}" method="GET" autocomplete="off">-->
                <form method="GET" autocomplete="off">
                    <!--<div class="row">
                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <select class="custom-select" name="opcion">
                                    <option value="clave_emp">Clave</option>
                                    <option value="nombre_emp">Nombre</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" name="busca" aria-describedby="basic-addon1" align='right' onkeyup="mayus(this)"; required>
                        </div>
                    </div>-->
                    <table class="table table-bordered table-striped" id="example1">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Clave de Empleado</th>
                                    <th>Nombre de Empleado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($emp))
                                    @foreach($emp as $emp1)
                                        <tr>
                                            <td scope="row">{{ $emp1->clave_empleado }}</td>
                                            <td>{{ $emp1->nombre}} {{ $emp1->apellido_paterno }} {{ $emp1->apellido_materno }}</td>
                                            <td>
                                                @if(!empty($aux1))
                                                    <a href="{{ route('incidencias.seleccionarempleado2',array($emp1->clave_empleado,$aux1->clave_concepto)) }}">
                                                        <button type="button" style='width:70px; height:40px; align-items:center;'>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('incidencias.seleccionarempleado',$emp1->clave_empleado) }}">
                                                        <button type="button" style='width:70px; height:40px; align-items:center;'>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </div>
                    </table> 
                    <div class="modal-footer">
                        <button type="button" style="width:80px; height:40px" data-dismiss="modal">Cerrar</button>
                        <!--<button type="submit" style="width:80px; height:40px" name="acciones" value="buscar">Buscar</button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>