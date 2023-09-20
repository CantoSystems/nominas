<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title modalPersonalizado" id="myModalLabel">
            Buscar Regimen Fiscal
          </h4>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
          </button>
        </div>
          <div class="modal-body">
              <table id="fiscal" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th>Clave regimen</th>
                        <th>Descripcion Regimen</th>
                        <th>Ver</th>
                      </tr>
                  </thead>
                  <tbody>
                      @if(!empty($regimenes))
                          @foreach($regimenes as $reg)
                          <tr>
                              <td>{{ $reg->claveRegimen }}</td>
                              <td>{{ $reg->descripcionRegimen}}</td>
                              <td>
                                @canany(['administrador','capturista','reportes'])
                                <div>
                                    <center>
                                        <a href="{{ route('fical.create',$reg->id) }}">
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