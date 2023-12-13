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
                        <th>Para Ingresos De</th>
                                <th>Hasta Ingresos De</th>
                                <th>Cantidad de Subsidio</th>
                                <th>Periodo</th>
                                <th>Mostrar más</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($subsidios))
                            @foreach ($subsidios as $sub)
                            <tr>
                                <td>$ {{ number_format($sub->ParaIngresos,2,'.',',')  }}</td>
                                <td> $ {{ number_format($sub->hastaIngresos,2,'.',',')  }} </td>
                                <td> $ {{ number_format($sub->cantidadSubsidio,2,'.',',')  }} </td>
                                <td>{{ $sub->periodo_subsidio }}</td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('subsidios.mostrar',$sub->id_subsidio ) }}">
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