<div class="modal fade" id="modal-searchIncidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalPersonalizado" id="exampleModalLabel">Buscar ausentimo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('incid2.index')}}" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <label>No. de Incidencia</label>
                                <input type="number" name="idIncidenciaSearch" class="form-control" id="idIncidenciaSearch">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="botones-modales" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="acciones" value="buscar" class="botones-modales">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
