@if(!empty($aux))
    <div class="modal fade" id="modal-searchcon-{{ $aux->clave_empleado }}">
@else
    <div class="modal fade" id="modal-searchcon">
@endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Concepto</h4>
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
                    <table class="table table-bordered table-striped" id="example2">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Clave de Concepto</th>
                                    <th>Concepto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($conceptos))
                                    @foreach($conceptos as $concepto)
                                        <tr>
                                            <td scope="row">{{ $concepto->clave_concepto }}</td>
                                            <td>{{ $concepto->concepto }}</td>
                                            <td>
                                                @if(!empty($aux))
                                                    <a href="{{ route('incidencias.seleccionarconcept2',array($concepto->clave_concepto,$aux->clave_empleado)) }}">
                                                        <button type="button" style='width:70px; height:40px; align-items:center;'>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('incidencias.seleccionarconcept',$concepto->clave_concepto) }}">
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