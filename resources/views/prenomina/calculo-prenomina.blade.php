<div class="modal fade bs-example-modal-sm" tabindex="-1" id="calculo-prenomina{{$emplea->id_emp}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Prenomina {{ $emplea->nombre}} {{ $emplea->apellido_paterno }} {{ $emplea->apellido_materno }}
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
            <form method="GET">
                <div class="modal-body">
                  	@foreach($conceptos as $concep)
                  		<div class="col-sm-6">
                            <div class="form-group">
                            	<label>{{$concep->concepto}}</label>
                            	<input type="text" name="" value="" class="form-control"  onkeyup="mayus(this);" onkeypress="return validar(event);" >
                            </div>
                        </div>
                  	@endforeach
                </div>
            </form>
		</div>
	</div>
</div>