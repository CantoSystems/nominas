<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalPersonalizado" id="exampleModalLabel" class="modalPersonalizado">Buscar
                    Registro Infonavit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('infonavit.acciones')}}" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="input-group col-sm-12">
                            <div class="form-group">
                                <label>Año:</label>
                                <input type="text" class="form-control" aria-label="Username" name="busca"
                                    aria-describedby="basic-addon1" align='center' required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="botones-modales">Cerrar</button>
                        <button type="submit" name="acciones" value="buscar" class="botones-modales">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>