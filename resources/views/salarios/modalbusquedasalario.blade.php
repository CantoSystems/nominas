+<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalBusqSal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modalPersonalizado" id="myModalLabel">
                    Buscar Salario Mínimo
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="GET">
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="example1">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Término</th>
                                    <th>Región</th>
                                    <th>Importe</th>
                                    <th>Mostrar más</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($SalarioMin))
                                @foreach($SalarioMin as $salMinAll)
                                <tr>
                                    <td>{{ $salMinAll->fechaInicio}}</td>
                                    <td>{{ $salMinAll->fechafin }}</td>
                                    <td>{{ $salMinAll->region }}</td>
                                    <td>${{ number_format($salMinAll->importe,2,'.',',')  }}</td>
                                    <td style="width: 20px;">
                                        @canany(['administrador','capturista','reportes'])
                                        <div>
                                            <center>
                                                <a href="{{ route('salariomin.mostrar',$salMinAll->idSalarioMinimo) }}">
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
                        </div>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>