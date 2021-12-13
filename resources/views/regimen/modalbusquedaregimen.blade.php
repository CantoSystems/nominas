+<div class="modal fade bs-example-modal-sm" tabindex="-1" id="busqueda-regimen" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title modalPersonalizado" id="myModalLabel">
					Búsqueda régimen fiscal
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
            <form method="GET">
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="example1">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Clave régimen fiscal </th>
                                    <th>Descipción régimen fiscal</th>
                                    <th>Visualizar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($datosRegimen))
                          @foreach($datosRegimen as $reg)
                          <tr>
                              <td>{{ $reg->claveRegimen }}</td>
                              <td>{{ $reg->descripcionRegimen }}</td>
                              <td>
                                  @canany(['administrador','capturista'])
                                          <div>
                                                  <a href="{{ route('regimen.show',$reg->id) }}">
                                                      <button type="button" class="botones">
                                                          <i class="far fa-eye"></i>
                                                      </button>
                                                  </a>      
                                          </div>
                                  @endcan
                              </td>
                          </tr>
                          @endforeach
                      @endif
                            </tbody>
                        </div>
                    </table> 
                </div>
            </form>
		</div>
	</div>
</div>