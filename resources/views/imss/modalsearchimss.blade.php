<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar Concepto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('imss.acciones')}}" method="GET" autocomplete="off">
          <div class="row">
            <div class="input-group col-md-12">
              <div class="input-group-prepend">
                  <label for="busca">Concepto &nbsp</label>
              </div>
              <input type="text" class="form-control" aria-label="Username" name="busca" aria-describedby="basic-addon1" align='right' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="width:80px; height:40px" data-dismiss="modal">Cerrar</button>
            <button type="submit" name="acciones" value="buscar" style="width:80px; height:40px">Buscar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>