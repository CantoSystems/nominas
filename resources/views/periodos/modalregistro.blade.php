<div class="modal fade bs-example-modal-lg" id="AgregarPeriodo" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir periodos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('agregarperiodos')}}">
          @csrf
               <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Fecha de Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="inputEmail4">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="inputPassword4">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de Pago</label>
                    <input type="date" class="form-control" name="fecha_pago" id="inputPassword4">
                  </div>
                </div> 
                    <button type="button" data-dismiss="modal">Cerrar</button>
          <button type="submit">Guardar</button>
            </form>
        </div>
        <div class="modal-footer">
      
        </div>
      </div>
    </div>
  </div>