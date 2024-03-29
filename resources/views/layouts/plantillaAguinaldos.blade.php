<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CDB | Nominas</title>
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/Admin/dist/css/adminlte.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{ asset('estilos-personalizados/plantillados.css')}}">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto"></ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary bg-gray elevation-4">
      <a href="#" class="brand-link" style="font-size: 1.5em">
        <img src="{{ asset('/Admin/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Session::get('empresa') }} <br> </span>
      </a>
      <center>
        <a href="{{ route('home')}}" class="nav-link">
          <i class="fas fa-external-link-alt"></i>
          Cambiar empresa
        </a>
      </center>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-list-ul"></i>
                <p>
                  Catálogos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('emplea.index') ?: 'active'}}">
                  <a href="{{ route('emplea.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Empleados</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('conceptos.index') ?: 'active'}}">
                  <a href="{{route('conceptos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conceptos</p>
                  </a>
                </li> 
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('selectConceptos.index') ?: 'active'}}">
                  <a href="{{route('selectConceptos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Seleccionar Conceptos</p>
                  </a>
                </li> 
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('areas.index') ?: 'active'}}">
                <a href="{{route('areas.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Áreas</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('descansos.index') ?: 'active'}}">
                <a href="{{route('descansos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Días de descanso obligatorio</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('departamentos.index') ?: 'active'}}">
                  <a href="{{ route('departamentos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departamentos</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('puestos.index') ?: 'active'}}">
                <a href="{{route('puestos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Puestos</p>
                  </a>
                </li> 
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('periodos.acciones') ?: 'active'}}">
                  <a href="{{ route('periodos.acciones')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Periodos</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('prestaciones.index') ?: 'active'}}">
                  <a href="{{ route('prestaciones.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prestaciones</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="far fa-edit"></i>
                <p>
                  Captura
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('ausencia.index') ?: 'active'}}">
                  <a href="{{ route('ausencia.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ausentismo</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('tiempo.index') ?: 'active'}}">
                  <a href="{{ route('tiempo.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tiempo Extra</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('incidencias.index') ?: 'active'}}">
                  <a href="{{ route('incidencias.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Incidencias</p>
                  </a>
                </li>
              </ul>
              <!--<ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('prestamos.index') ?: 'active'}}">
                  <a href="{{ route('prestamos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Capturar Adicionales</p>
                  </a>
                </li>
              </ul>-->
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="fas fa-book"></i>
                <p>
                  Cambios y consultas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('ausentismo.index') ?: 'active'}}">
                  <a href="{{ route('ausentismo.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ausentismo</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('horasextras.index') ?: 'active'}}">
                  <a href="{{ route('horasextras.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tiempo Extra</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('incid2.index') ?: 'active'}}">
                  <a href="{{ route('incid2.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Incidencias</p>
                  </a>
                </li>
              </ul>
              <!-- <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('prestamos.show') ?: 'active'}}">
                  <a href="{{ route('prestamos.show')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Consultar Adicionales</p>
                  </a>
                </li>
              </ul>-->
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Nómina
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('control.index') ?: 'active'}}">
                  <a name="botonNominas" id="botonNominas" href="{{ route('control.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prenómina</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('reportnomina.index') ?: 'active'}}">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nómina normal</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('reportnomina.index') ?: 'active'}}">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Recibo</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Nómina aguinaldo
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('aguinaldosP.index') ?: 'active'}}">
                  <a name="botonAguinaldo" id="botonAguinaldo" href="{{ route('aguinaldosP.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prenómina</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nómina normal</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Recibo</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Nómina PTU
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('ptu.index') ?: 'active'}}">
                  <a name="botonAguinaldo" id="botonAguinaldo" href="{{ route('ptu.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prenómina</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nómina normal</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Recibo</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Nómina especial
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a name="botonNominas" id="botonNominas" href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Prenómina</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nómina normal</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('reportnomina.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Recibo</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
          </div>
        </div>
      </div>
      @yield('content')
    </div>
    <footer class="main-footer">
      <strong>Canto Contadores &copy; 1989-2021</strong>
    </footer>

    <!-- REQUIRED SCRIPTS Generales-->
    <script src="{{ asset('/Admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/Admin/dist/js/adminlte.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!--Funcionamiento Datatable-->
    <script src="{{ asset('/script-personalizados/datatables.js')}}"></script>
    <!--Funcionamiento Botones-->
    <script src="{{asset('/script-personalizados/funcionamientoBotones.js')}}"></script>
    <!--Validaciones inputs mayusculas, números y letras-->
    <script src="{{asset('/script-personalizados/validacionesInput.js')}}"></script>
    <!-- Scripts para Aguinaldos-->
    <script>
      $(document).ready(function(){
        $('#divEmp').html('<h6 id="nombreEmp" class="card-title"><b>Empleado:</b> No ha seleccionado ningún empleado</h6>');
      });

      $('.aguinaldo').on('click', function(){
        $.ajax({
          url:"{{ route('aguinaldosP.create') }}",
          method: "POST",
          dataType: 'json',
          data: {
              _token: $("meta[name='csrf-token']").attr("content"),
              clvEmp: $(this).closest('button').val(),
              calculoISR: $('#calculoISR').val(),
          },
          success: function(data){
            $('#modalbusquedaempAg').modal('hide');
            $('#divEmp').html('<h6 id="nombreEmp" class="card-title"><b>Empleado:</b> '+data['clave']['nombre']+' '+data['clave']['apellido_paterno']+' '+data['clave']['apellido_materno']+'</h6>');
            let htmlTags = '<tr>'+
                              '<td style="text-align: center;">' + data['aguinaldo'][0]['clave_concepto'] + 
                                '<input type="hidden" class="datos clvCncpt" value="'+ data['aguinaldo'][0]['clave_concepto'] +'">'+
                              '</td>'+
                              '<td style="text-align: center;">' + data['aguinaldo'][0]['concepto'] +
                                '<input type="hidden" class="datos clvEmp" value="'+ data['clave']['clave_empleado'] +'">'+
                              '</td>'+
                              '<td  style="text-align: center;">$ ' + data['aguinaldo'][0]['monto'].toFixed(2) + 
                                '<input type="hidden" class="datos monto" value="' + data['aguinaldo'][0]['monto'].toFixed(2) +'">'+
                              '</td>'+
                            '</tr>'
            $('#filasPercepciones tbody').append(htmlTags);
            $(".totalPercepTrab").val(data['aguinaldo'][0]['monto'].toFixed(2));

            let htmlTags2 = '<tr>'+
                              '<td style="text-align: center;">' + data['ISRRetenerFinal'][0]['clave_concepto'] + 
                                '<input type="hidden" class="datos clvCncpt" value="'+ data['ISRRetenerFinal'][0]['clave_concepto'] +'">'+
                              '</td>'+
                              '<td style="text-align: center;">' + data['ISRRetenerFinal'][0]['concepto'] +
                                '<input type="hidden" class="datos clvEmp" value="'+ data['clave']['clave_empleado'] +'">'+
                              '</td>'+
                              '<td  style="text-align: center;">$' + data['ISRRetenerFinal'][0]['monto'].toFixed(2) + 
                                '<input type="hidden" class="datos monto" value="'+ data['ISRRetenerFinal'][0]['monto'].toFixed(2) +'">'+
                              '</td>'+
                            '</tr>'
            $('#filasImpuestos tbody').append(htmlTags2);
            $(".totalImpTrab").val(data['ISRRetenerFinal'][0]['monto'].toFixed(2));

            let htmlTags3 = '<tr>'+
                              '<td style="text-align: center;">' + data['aguinaldoFinal'][0]['clave_concepto'] + 
                                '<input type="hidden" class="datos clvCncpt" value="'+ data['aguinaldoFinal'][0]['clave_concepto'] +'">'+
                              '</td>'+
                              '<td style="text-align: center;">' + data['aguinaldoFinal'][0]['concepto'] +
                                '<input type="hidden" class="datos clvEmp" value="'+ data['clave']['clave_empleado'] +'">'+
                              '</td>'+
                              '<td  style="text-align: center;">$ ' + data['aguinaldoFinal'][0]['monto'].toFixed(2) + 
                                '<input type="hidden" class="datos monto" value="' + data['aguinaldoFinal'][0]['monto'].toFixed(2) +'">'+
                              '</td>'+
                            '</tr>'
            $('#filasTotales tbody').append(htmlTags3);
            $(".totalSueldoNeto").val(data['aguinaldoFinal'][0]['monto'].toFixed(2));
          },
          error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            console.log(err.Message);
          }
        });
      });

      $('#acciones').on('click', function(){
        $('#filasPercepciones tbody tr').detach();
        $('#filasImpuestos tbody tr').detach();
        $('#filasTotales tbody tr').detach();
        $(".totalImpTrab").val("");
        $(".totalPercepTrab").val("");
        $(".totalSueldoNeto").val("");
        $(".datos").val("");
        $("#calculoISR").val("N/A");
        $('#divEmp').html('<h6 id="nombreEmp" class="card-title"><b>Empleado:</b> No ha seleccionado ningún empleado</h6>');
      });

      $('#autorizar').click(function(e){
        e.preventDefault();
        let myTableControl = [];
        document.querySelectorAll('.control tbody tr').forEach(function(e){
          let fila = {
            concepto:   e.querySelector('.clvCncpt').value,
            monto:      e.querySelector('.monto').value,
            clvEmp:     e.querySelector('.clvEmp').value,
          };
          myTableControl.push(fila);
        });
        let jsonString = JSON.stringify(myTableControl);
        $.ajax({
          url: "{{ route('aguinaldosP.store') }}",
          method: "POST",
          data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            info : jsonString,
            totalAguinaldo : $(".totalPercepTrab").val() - $(".totalImpTrab").val(),
            clvEmp : $(".clvEmp").val(),
          },
          success: function(data){
            console.log(data);
          },
          error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            console.log(err.Message);
          }
        });
      });
    </script>