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
                        <th>Periodo Inicio</th>
                        <th>Periodo Final</th>
                        <th>UMA</th>
                        <th> Mostrar más</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($umas))
                            @foreach ($umas as $um)
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($um->periodoinicio_uma)) }}</td>
                                <td>{{ date('d-m-Y',strtotime($um->periodofin_uma)) }}</td>
                                <td>${{ 
                                    number_format($um->porcentaje_uma,2,'.',',')
                                     
                                }}</td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('umas.mostrar',$um->id) }}">
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