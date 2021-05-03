<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalPersonalizado" id="exampleModalLabel">Buscar días de descanso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('descansos.index')}}" method="GET" autocomplete="off">
            <div class="row">
  
                <div class="input-group col-md-12">
                  <div class="input-group-prepend">
                    <select class="custom-select" name="opcion">
                        <option value="fecha">Fecha descanso</option>
                      </select>
                  </div>
                  <input type="date" class="form-control" aria-label="Username" required name="busca" aria-describedby="basic-addon1" onkeyup="mayus(this)"; align='right'>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="botones-modales" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="botones-modales" name="acciones" value="buscar">Buscar</button>
        </div>
            </form>
      </div>
    </div>
  </div>
</div>
