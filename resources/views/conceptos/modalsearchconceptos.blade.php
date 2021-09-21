<div class="modal fade bs-example-modal-sm" tabindex="-1" id="exampleModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title modalPersonalizado" id="myModalLabel">
					Buscar Concepto
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
                                    <th>Clave concepto</th>
                                    <th>Concepto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($conceptosAll))
                                    @foreach($conceptosAll as $concep)
                                        <tr>
                                            <td scope="row">{{ $concep->clave_concepto }}</td>
                                            <td>{{ $concep->concepto}}</td>

                                            <td style="width: 20px;">
                                                @canany(['administrador','capturista'])
                                                    <div>
                                                        <center>
                                                            <a href="{{ route('conceptos.mostrar',$concep->id) }}">
                                                                <button type="button" class="botones">
                                                                    <i class="far fa-eye"></i>
                                                                </button>
                                                            </a>
                                                        </center>         
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