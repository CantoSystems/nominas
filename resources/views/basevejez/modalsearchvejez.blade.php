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
                                <th>De SBC Cesantía y Vejez</th>
                                <th>Hasta SBC Cesantía y Vejez</th>
                                <th>Cuota patronal</th>
                                <th>Mostrar más</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($basevejez))
                            @foreach ($basevejez as $base)
                            <tr>
                                <td>{{$base->de_salariocotizacion_vejez}}</td>
                                <td>{{$base->hasta_salariocotizacion_vejez}}</td>
                                <td>{{$base->cuotapatronal_vejez}}</td>
                                <td>
                                    @canany(['administrador','capturista','reportes'])
                                    <div>
                                        <center>
                                            <a href="{{ route('vejez.mostrar',$base->id) }}">
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