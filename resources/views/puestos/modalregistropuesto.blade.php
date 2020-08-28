<div class="modal fade bs-example-modal-lg" id="AgregarPeriodo" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir Puesto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('agregarperiodos')}}">
          @csrf
               <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Nombre del Puesto</label>
                    <input type="text" class="form-control" name="puesto" id="puesto">
                  </div>
                  
                </div> 

                <div class="form-group col-md-4">
                  <div></div>
                </div>

                <div class="form-group col-md-8">
                  <button type="button" data-dismiss="modal" style="width:220px; height:40px">Cerrar
                  </button>
                  <button type="submit" style="width:220px; height:40px">Guardar
                  </button>
                </div>

          
            </form>
        </div>
        <div class="modal-footer">
      
        </div>
      </div>
    </div>
  </div>