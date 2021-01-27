<div class="modal fade" id="modal-searchemp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buscar Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('incidencias.index')}}" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <select class="custom-select" name="opcion">
                                    <option value="clave_emp">Clave</option>
                                    <option value="nombre_emp">Nombre</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" name="busca" aria-describedby="basic-addon1" align='right' onkeyup="mayus(this)"; required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="width:80px; height:40px" data-dismiss="modal">Cerrar</button>
                        <button type="submit" style="width:80px; height:40px" name="acciones" value="buscar">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>