<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modal-deletepuesto{{$aux->id}}" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">
		Eliminar puesto
	</h4>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form class="" action="{{ route('puestos.eliminapuesto', $aux->id )}}" method="post">
@method('DELETE')
@csrf
<div class="row">
<h5 style="text-align: center;">¿Estas seguro de eliminar este puesto: 
	<strong>{{$aux->nombre_puesto}}</strong>
?</h5>
</div>




</div>
<div class="modal-footer">
<button type="button" data-dismiss="modal" style="width:80px; height:40px">Cancelar</button>
<button type="submit" style="width:90px; height:40px">Continuar</button>
</form>
</div>
</div>
</div>
</div>