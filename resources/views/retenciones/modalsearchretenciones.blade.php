<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                                <td scope="row">
                                   $ {{ number_format($rtn->limite_inferior,2,'.',',') }}
                                </td>
                                <td>  $ {{ number_format($rtn->limite_superior,2,'.',',') }} </td>
                                <td> $ {{ number_format($rtn->cuota_fija,2,'.',',') }} </td>
                                <td> {{ number_format($rtn->porcentaje_excedente,2,'.',',') }} %</td>
                                <td>{{ $rtn->periodo_retencion }} </td>
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