<div class="modal fade bs-example-modal-lg" tabindex="-1" id="modal-deletenom-{{$empresa->id}}" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Eliminar Empresa: {{$empresa->nombre}}</h4>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form class="" action="{{route('empresas.destroy', $empresa->id)}}" method="post">
@method('DELETE')
@csrf
<div class="row">
<h3>¿Estas seguro de eliminar esta empresa?</h3>
</div>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
<button class="btn btn-primary" type="submit">Continuar</button>
</form>



</div>
<div class="modal-footer">

</div>
</div>
</div>
</div>