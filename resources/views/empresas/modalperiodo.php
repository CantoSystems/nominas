  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear periodo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form action="#" method="GET">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Número de periodo:</label>
                    <input type="number" name="numero" min="1"  max="30" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha inicio:</label>
                      <select class="custom-select" name="fecha_inicio">
                        <option value="">
                         Fecha Ejemplo
                        </option> 
                      </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha fin:</label>
                      <select class="custom-select" name="fecha_fin">
                        <option value="">
                         Fecha Ejemplo fin
                        </option> 
                      </select>
                </div>
              </div>
               <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha fin:</label>
                      <input type="hidden" name="fecha_pago">
                </div>
              </div>
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
         </form> 
        </div>
      </div>
    </div>
  </div>