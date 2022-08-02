<div class="modal fade bs-example-modal-sm" id="busqueda-regimen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modalPersonalizado" id="myModalLabel">
                    Búsqueda régimen fiscal
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Clave Régimen Fiscal </th>
                            <th>Descipción Régimen Fiscal</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($datosRegimen))
                        @foreach($datosRegimen as $reg)
                        <tr>
                            <td>{{ $reg->claveRegimen }}</td>
                            <td>{{ $reg->descripcionRegimen }}</td>
                            <td>
                                @canany(['administrador','capturista'])
                                <div>
                                    <center>
                                        <a href="{{ route('regimen.show',$reg->id) }}">
                                            <button type="button" class="botones-modales">
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
                </table>
            </div>
        </div>
    </div>