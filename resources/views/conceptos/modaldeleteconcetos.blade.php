<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modal-deleteconcepto-{{$aux->id}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Eliminar concepto
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('conceptos.eliminaconcepto', $aux->id ?? '')}}" method="post">
					@method('DELETE')
					@csrf
					<div class="row">
						<h5 style="text-align: center;">¿Estas seguro de eliminar este concepto: 
							<strong>{{$aux->concepto ?? ''}}</strong>?
						</h5>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" style="width:80px; height:40px">Cancelar</button>
						<button type="submit" style="width:90px; height:40px">Continuar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>