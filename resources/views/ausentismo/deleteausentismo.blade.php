<div 	class="modal fade bs-example-modal-sm" tabindex="-1" 
		id="modal-deleteausent-{{$ausentismo->id}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title modalPersonalizado" id="myModalLabel">Eliminar ausentismo</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="" action="{{ route('ausentismo.destroy', $ausentismo->id )}}" method="post">
					@method('DELETE')
					@csrf
					<div class="row">
						<h5 style="text-align: center;">¿Estas seguro de eliminaresta incapacidad: 
							<strong>{{$ausentismo->incapacidad}}</strong>?
						</h5>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="botones-modales">Cancelar</button>
						<button type="submit" class=botones-modales">Continuar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>