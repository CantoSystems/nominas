<div class="modal fade bs-example-modal-lg" id="modalbuscarempleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buscar Empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ausentismo.index')}}" method="GET" autocomplete="off">
             <div class="col">
              <div class="input-group-prepend">
          <div class="input-group-text">
            <span class="fa fa-search">
            </span>
            </div>
        <input type="search" name="titulo" class="bg8 s-text6" placeholder="Ingrese clave">
      </div>
      <div><br></div>
 
      </div>
        <div class="modal-footer">
          <button type="button"  style="width:80px; height:40px" data-dismiss="modal">Cerrar</button>
          <!--<button type="submit"  style="width:80px; height:40px" name="acciones" value="buscar">Buscar</button>-->
        </div>
            </form>
      </div>
    </div>
  </div>
</div>