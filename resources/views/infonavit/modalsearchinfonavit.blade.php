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
                        <th style="text-align: center;">Año</th>
                                <th style="text-align: center;">Valor Veces Salario Mínimo</th>
                                <th style="text-align: center;">Valor % UMA</th>
                                <th style="text-align: center;">Valor Unidad Mixta Infonavit</th>
                                <th>Mostrar más</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($infonavitGral))
                            @foreach ($infonavitGral as $inf)
                            <tr>
                                <td style="text-align: center;" scope="row">{{ $inf->anio }}</td>
                                <td style="text-align: center;">{{ number_format($inf->vsm,2,'.',',')  }}</td>
                                <td style="text-align: center;">{{ number_format($inf->varUma,2,'.',',')  }} </td>
                                <td style="text-align: center;">{{ number_format($inf->valorInfonavit,2,'.',',')  }} </td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('infonavit.mostrar',$inf->id) }}">
                                                <button type="button" title="Mostrar más" class="botones">
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