
<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modal-deleteausentismo-{{$ausentismo->id}}" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar ausentismo</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ausentismo.eliminar', $ausentismo->id )}}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <h5 style="text-align: center;">{{$ausentismo->id}} ¿Estas seguro de eliminar esta incapcidad: 
                            <strong>{{$ausentismo->incapacidad}}</strong>?
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