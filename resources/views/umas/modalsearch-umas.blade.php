<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title modalPersonalizado" id="exampleModalLabel">Buscar UMA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('umas.index')}}" method="GET" autocomplete="off">
            <div class="row">
  
                <div class="input-group col-md-12">
                  <div class="input-group-prepend">
                    <select class="custom-select personalizado" name="opcion">
                      <option value="id">Clave: &nbsp; &nbsp; &nbsp;</option>
                      <option value="inical">Periodo Inicial: &nbsp; &nbsp; &nbsp;</option>
                      <option value="final">Perido Final: &nbsp; &nbsp; &nbsp;</option>
                    </select>
                  </div>
                  <input type="text" class="form-control" aria-label="Username" name="busca" aria-describedby="basic-addon1" align='right' required>
                   
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