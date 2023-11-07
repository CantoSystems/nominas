<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modalPersonalizado" id="myModalLabel">
                    Buscar
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Limite Inferior</th>
                                <th>Limite Superior</th>
                                <th>Cuota fija</th>
                                <th>Porcentaje Excedente</th>
                                <th>Periodo</th>
                                <th>Mostrar más</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($isr))
                            @foreach ($isr as $rtn)
                            <tr>
                                <th scope="row">
                                    {{ $rtn->limite_inferior }}
                                </th>
                                <td> {{ $rtn->limite_superior }}</td>
                                <td>{{ $rtn->cuota_fija }}</td>
                                <td>{{ $rtn->porcentaje_excedente }}</td>
                                <td>{{ $rtn->periodo_retencion }}</td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('retenciones.mostrar',$rtn->id) }}">
                                                <button title="Mostrar más" type="button" class="botones">
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
</div>