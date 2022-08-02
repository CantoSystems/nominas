<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <th>Nombre Empresa</th>
                            <th>Clave </th>
                            <th>Nombre nómina</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($nominas))
                        @foreach($nominas as $nom)
                        <tr>
                            <td>{{ $nom->nombre }}</td>
                            <td>{{ $nom->clave }}</td>
                            <td>{{ $nom->nombre_nomina }}</td>
                            <td>
                                @canany(['administrador','capturista'])
                                <div>
                                    <center>
                                        <a href="{{ route('mostrar.empresas',$nom->id) }}">
                                            <button type="button" class="botones-modales">
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