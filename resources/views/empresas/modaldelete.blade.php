<div class="modal fade" tabindex="-1" id="modal-deletenom-{{$empresa->id}}" role="dialog" aria-hidden="true">
    <!--modal fade bs-example-modal-sm-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modalPersonalizado" id="myModalLabel">Eliminar Empresa: {{$empresa->nombre}}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{route('empresas.destroy', $empresa->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <h3 class="modalPersonalizado">¿Estas seguro de eliminar esta empresa?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-dismiss="modal" class="botones-modales">Cancelar</button>
                        <button  type="submit" class="botones-modales">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>