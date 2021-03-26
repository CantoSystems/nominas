<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalBusqSal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Buscar Salario Mínimo
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
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Término</th>
                                    <th>Región</th>
                                    <th>Importe</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($salMins))
                                    @foreach($salMins as $salMinAll)
                                        <tr>
                                            <td>{{ $salMinAll->fechaInicio}}</td>
                                            <td>{{ $salMinAll->fechafin }}</td>
                                            <td>{{ $salMinAll->region }}</td>
                                            <td>{{ $salMinAll->importe }}</td>
                                            <td style="width: 20px;">
                                                @canany(['administrador','capturista'])
                                                    <div>
                                                        <center>
                                                            <a href="{{ route('salariomin.mostrar',$salMinAll->idSalarioMinimo) }}">
                                                                <button type="button" style='width:70px; height:40px'>
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