<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modal-deletesubsidio-{{ $subsidio->id_subsidio }}" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Eliminar Subsidio
				</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('subsidio.eliminarsubsidio', $subsidio->id_subsidio )}}" method="post">
					@method('DELETE')
					@csrf
					<div class="row">
						<h5 style="text-align: center;">¿Estas seguro de eliminar este Subsidio: 
							<strong>{{ $subsidio->ParaIngresos }}</strong>?
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