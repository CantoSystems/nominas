<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modalPersonalizado" id="myModalLabel">
          Buscar Tabla IMSS
        </h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> Concepto</th>
                        <th> Prestaciones </th>
                        <th> Cuota Patrón </th>
                        <th> Cuota Trabajador </th>
                        <th> Cuota Total</th>
                        <th> Base </th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($imsss))
                        @foreach($imsss as $timss)
                        <tr>
                            <td>{{ $timss->concepto }}</td>
                            <td>{{ $timss->prestaciones}}</td>
                            <td>{{ $timss->cuotapatron}} </td>
                            <td>{{ $timss->cuotatrabajador }}</td>
                            <td>{{ $timss->cuotatotal}}</td>
                            <td>{{ $timss->base}}</td>
                            <td>
                              @canany(['administrador','capturista','reportes'])
                              <div>
                                  <center>
                                      <a href="{{ route('imss.mostrar',$timss->id_imss) }}">
                                          <button type="button" class="botones">
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