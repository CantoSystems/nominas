@if(!empty($emplea))
    <div class="modal fade" id="modalbuscarempleado{{$emplea->clave }}">
@else
    <div class="modal fade" id="modal-buscarempleado">
@endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buscar Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" autocomplete="off">



                   <!--Código Aquí-->
                    <table class="table table-bordered table-striped" id="example1">
                        <div class="col-sm-12">
                            <thead>
                                <tr>
                                    <th>Clave de Empleado</th>
                                    <th>Nombre de Empleado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($empleado))
                                    @foreach($empleado as $emp)
                                        <tr>
                                            <td scope="row">{{ $emp->clave_empleado }}</td>
                                            <td>{{ $emp->nombre}} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</td>
                                            <td>
                                                @if(!empty($aux1))
                                                    <a href="{{ route('ausentismo.seleccionarempleado2',array($emp1->clave_empleado,$aux1->clave_concepto)) }}">
                                                        <button type="button" style='width:70px; height:40px; align-items:center;'>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('ausentismo.seleccionarempleado',$emp->clave_empleado) }}">
                                                        <button type="button" style='width:70px; height:40px; align-items:center;'>
                                                            <i class="fas fa-check-circle"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </div>
                    </table> 

                   <!---Fin Datatable-->



                    <div class="modal-footer">
                        <button type="button" style="width:80px; height:40px" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>