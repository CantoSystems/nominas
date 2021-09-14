<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modalPersonalizado" id="myModalLabel">
          Buscar Nómina
        </h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Prestaciones </th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($imsss))
                        @foreach($imsss as $timss)
                        <tr>
                            <td>{{ $timss->concepto }}</td>
                            <td>{{ $timss->prestaciones}}</td>
                            <td>{{ $timss->id_imss}}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
    </div>
  </div>
</div>