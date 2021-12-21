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
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('prestamos.index') ?: 'active'}}">
                  <a href="{{ route('prestamos.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Capturar Adicionales</p>
                  </a>
                </li>
              </ul>
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
              <ul class="nav nav-treeview">
                <li class="nav-item {{!Route::is('prestamos.show') ?: 'active'}}">
                  <a href="{{ route('prestamos.show')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Consultar Adicionales</p>
                  </a>
                </li>
              </ul>
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
    <!-- Scripts para Prenómina-->
    <script>
      $(document).ready(function(){
        /* Scripts para generar los resultados de las operaciones al cargar la página */
        let importe_total = 0
        $(".totales").each(function(index, value) {
          if($.isNumeric($(this).val())){
            importe_total = importe_total + eval($(this).val());
          }
        });
        $(".totalPercepciones").val(importe_total.toFixed(2));
        $(".conceptoPercepciones").val("01TP");


        let htmlTotal;

        let importe_total2 = 0
        $(".totales2").each(function(index, value) {
          if($.isNumeric($(this).val())){
            importe_total2 = importe_total2 + eval($(this).val());
          }
        });
        $(".totalDeducciones").val(importe_total2.toFixed(2));
        $(".conceptodeducciones").val("02TD");

        /* Suma Percepciones Gravadas */
        let importe_totalGrav = 0
        $(".percepGrav").each(function(index, value) {
          if($.isNumeric($(this).val())){
            importe_totalGrav = importe_totalGrav + eval($(this).val());
          }
        });
        $(".totalPercepcionesGravadas").val(importe_totalGrav);

        /* Suma Percepciones NO Gravadas */
        let importe_totalNoGrav = 0
        $(".percepExcentas").each(function(index, value) {
          if($.isNumeric($(this).val())){
            importe_totalNoGrav = importe_totalNoGrav + eval($(this).val());
          }
        });
        $(".totalPercepcionesExcentas").val(importe_totalNoGrav);

        /* Script para calcular los impuestos */
        $.ajax({
          url: "{{ route('control.Impuestos') }}",
          method: "POST",
          data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            totalPercepcionesGrav: $('.totalPercepcionesGravadas').val(),
            totalPercepcionesNoGrav: $('.totalPercepcionesExcentas').val(),
          },
          success: function(data){
            empclave = $('#extraerEmp').val();
            let htmlTags = '<tr>'+
                              '<td style="text-align: center;">' + data[0] + 
                              '<input type="hidden" class="clvCncpt" value="'+data[0]+'">'+
                              '</td>'+
                              '<td style="text-align: center;">' + data[1] +
                              '<input type="hidden" class="clvEmp" value="'+empclave+'">'+
                               '</td>'+
                              '<td style="text-align: center;">$ ' + data[2].toFixed(2) + 
                                '<input type="hidden" class="monto" value="'+ data[2].toFixed(2) +'">'+
                              '<input class="totales3" id="trabajadorIsr" type="hidden" value=" ' + data[2].toFixed(2) + ' ">'+
                              '</td>'+
                            '</tr>'
            $('#filasImpuestos tbody').append(htmlTags);
          },
          error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            console.log(err.Message);
          }
        });

        /* Script para calcular el IMSS */
        $.ajax({
          url: "{{ route('control.IMSS') }}",
          method: "POST",
          data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            clvEmp: $('.clvEmp').val(),
            totalImss: $('.totalPercepcionesIMSS').val(),
          },
          success: function(data){
            console.log(data);
            /*let htmlTags = '<tr>'+
                              '<td style="text-align: center;">' + data[0] + 
                              '<input type="hidden" class="clvCncpt" value="'+data[0]+'">'+
                              '</td>'+
                              '<td style="text-align: center;">' + data[1] +
                              '<input type="hidden" class="clvEmp" value="'+empclave+'">'+
                              '</td>'+
                              '<td  style="text-align: center;">$ ' + data[2].toFixed(2) + 
                                '<input type="hidden" class="monto" value="'+ data[2].toFixed(2) +'">'+
                              '<input class="totales3" id="trabajadorImss" type="hidden" value=" ' + data[2].toFixed(2) + ' ">'+
                              '</td>'+
                            '</tr>'
            $('#filasImpuestos tbody').append(htmlTags);*/

            let importe_total3 = 0;
            $(".totales3").each(function(index, value){
              if($.isNumeric($(this).val())){
                importe_total3 = importe_total3 + eval($(this).val());
              }
            });
            $(".totalImpuestosTrabajador").val(importe_total3.toFixed(2));
            $(".conceptoTrabajador").val("04TT");
            totalImpuestos = $(".totalImpuestosTrabajador").val();
            totalDeducciones = $(".totalDeducciones").val();
            totalPercepciones = $(".totalPercepciones").val();
            totalSueldoIn = totalPercepciones - totalDeducciones - totalImpuestos;
            $.ajax({
              url: "{{ route('control.pension') }}",
              method: "POST",
              data: {
                _token: $("meta[name='csrf-token']").attr("content"),
                clvEmp: $('.clvEmp').val(),
                totalSueldo: totalSueldoIn
              },
              success: function(data){
                if(data[0] != ''){
                  //$('.otrasDeducciones').css('display', 'block');
                  let htmlTags = '<tr>'+
                                  '<td style="text-align: center;">' + data[0] +
                                  '<input type="hidden" class="form-control clvCncpt" value="'+data[0]+'">'+
                                  '</td>'+
                                  '<td colspan="2" style="text-align:center;">'+ data[1] +
                                  '<input type="hidden" class="form-control clvEmp" value="'+data[4]+'">'+
                                  '</td>'+
                                  '<td style="text-align: center;">$' + data[3].toFixed(2) +
                                  '<input type="text" class="form-control monto totales2" value="'+ data[3].toFixed(2) +'">'+
                                  '</td>'+
                                '</tr>'

                  $('.inputTotalOD').val(data[3].toFixed(2));
                  $('#filasDeducciones tbody').append(htmlTags);

                  let importe_total2 = 0
                  $(".totales2").each(function(index, value) {
                    if($.isNumeric($(this).val())){
                      importe_total2 = importe_total2 + eval($(this).val());
                    }
                  });
                  $(".totalDeducciones").val(importe_total2.toFixed(2));
                  $(".conceptodeducciones").val("02TD");
                }

                $('#lblSueldoNeto').append("Sueldo Neto: $ " + data[2]);
                let htmlTags =  '<tr>'+
                                  '<td style="text-align: center;">001S'+
                                    '<input type="hidden" class="clvCncpt" value="001S">'+
                                  '</td>'+
                                  '<td style="text-align: center;">PAGO NETO'+
                                  '<input type="hidden" class="clvEmp" value="'+empclave+'">'+
                                  '</td>'+
                                  '<td style="text-align: center;">$'+ data[2] + 
                                    '<input type="hidden" class="monto" value="'+ data[2] +'">'+
                                  '</td>'+
                                '</tr>'
                
                $('#filasTotales tbody').append(htmlTags);
                $('.inpTotalNeto').val(data[2]);
                
                $.ajax({
                  url: "{{ route('control.impPatron') }}",
                  method: "POST",
                  data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    clvEmp: $('.clvEmp').val(),
                    percepciones: totalPercepciones
                  },
                  success: function(data){
                    console.log(data);
                    /*$.each(data, function(index) {                     
                      htmlTags = '<tr>'+
                                    '<td style="text-align: center;">' + data[index].clave_concepto +
                                    '<input type="hidden" class="clvCncpt" value="'+data[index].clave_concepto+'">'+
                                    '</td>'+
                                    '<td style="text-align: center;">' + data[index].concepto +
                                    '<input type="hidden" class="clvEmp" value="'+empclave+'">'+
                                    '</td>'+
                                    
                                    '<td  style="text-align: center;">$ ' + data[index].monto +
                                    '<input type="hidden" class="monto" value="'+ data[index].monto +'">'+
                                    '<input class="totales4" id="impPatron" type="hidden" value=" ' + data[index].monto + ' "></td>'+
                                 '</tr>'
                      $('#filasPatron tbody').append(htmlTags);
                    });

                    let importe_total4 = 0;
                    $(".totales4").each(function(index, value){
                      if($.isNumeric($(this).val())){
                        importe_total4 = importe_total4 + eval($(this).val());
                      }
                    });
                    $(".totalImpuestosPatron").val(importe_total4.toFixed(2));
                    $(".conceptoPatron").val("03TI");*/
                  },
                  error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    console.log(err.Message);
                  }
                });
              },
              error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                console.log(err.Message);
              }
            });
          },
          error: function(xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            console.log(err.Message);
          }
        });

        /* Script para guardar los cambios hechos en los inputs */
        $('#recalcular').click(function(e){
          e.preventDefault();
          let myTableArray = [];
          document.querySelectorAll('.prueba tbody tr').forEach(function(e){
            let fila = {
              idPre: e.querySelector('.idPrenomina').value,
              concepto: e.querySelector('.clvCncpt').value,
              monto: e.querySelector('.monto').value
            };
            myTableArray.push(fila);
          });
          let jsonString = JSON.stringify(myTableArray);
          $.ajax({
            url: "{{ route('prenomina.store') }}",
            method: "POST",
            data: {
              _token: $("meta[name='csrf-token']").attr("content"),
              info : jsonString,
            },
            success: function(data){
            },
            error: function(xhr, status, error) {
              var err = JSON.parse(xhr.responseText);
              console.log(err.Message);
            }
          });
        });
      });
    </script>
    
    <!--Script para el control de prenomina-->
    <script>
      $(document).ready(function(){
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
            //console.log(myTableControl);
          });
          let jsonString = JSON.stringify(myTableControl);
          $.ajax({
            url: "{{ route('control.store') }}",
            method: "POST",
            data: {
              _token: $("meta[name='csrf-token']").attr("content"),
              info : jsonString,
              totalGrav : $(".totalPercepcionesGravadas").val(),
              totalExc : $(".totalPercepcionesExcentas").val(),
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
      });
    </script>