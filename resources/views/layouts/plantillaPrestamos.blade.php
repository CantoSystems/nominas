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
              <!--<ul class="nav nav-treeview">
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
                <li class="nav-item {{!Route::is('aguinaldosP.index') ?: 'active'}}">
                  <a name="botonAguinaldo" id="botonAguinaldo" href="{{ route('aguinaldosP.index')}}" class="nav-link active">
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
    <!--Funcionamiento de Ausentismo Autocompletado -->
    <!-- Scripts para Autocomplete empleados y conceptos -->
    <script>
      $('#concepto_clave').keyup(function(){
        let consulta = $(this).val();  
          if(consulta != ''){
            let _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('ausentismo.mostrarconcepto') }}",
              method: "POST",
              data:{consulta:consulta,_token:_token},
              success:function(data){
                $('#listaconcepto_clave').fadeIn();
                $('#listaconcepto_clave').html(data);
              }
            });
          }
      });

      $(document).on('click','#concepto',function(){
        let infoconcepto = $(this).text();
        let concep = infoconcepto.substring(0,4);
        let nombreConcepto = infoconcepto.substring(4);
        $('#concepto_clave').val(concep);
        $('#listaconcepto_clave').fadeOut();
        $('#nomConcepto').val(nombreConcepto);
      });
      $('.clave_empledo').keyup(function(){
        let query = $(this).val();  
          if(query != ''){
            let _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('ausentismo.mostrarempleado') }}",
              method: "POST",
              data:{query:query,_token:_token},
              success:function(data){
                $('.listaclave_empleado').fadeIn();
                $('.listaclave_empleado').html(data);
                let sueldo = $("#sueldoDiario").val();
                
                $(document).on('click','#concepto',function(){
                  let info_concepto = $(this).text();
                  let concep_clave = info_concepto.substring(0,4);
                  if(concep_clave == "013P"){
                    $("#importe_incidencias").val(sueldo);
                    $("#importe_incidencias").attr("disabled", true);
                  }else{
                    $("#importe_incidencias").val('');
                    $("#importe_incidencias").attr("disabled", false);
                  }
                });
              }
            });
          }
      });
      
      $('.clave_empledo').keyup(function(){
        let query = $(this).val();  
          if(query != ''){
            let _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('ausentismo.mostrarempleado') }}",
              method: "POST",
              data:{query:query,_token:_token},
              success:function(data){
                $('.listaclave_empleado').fadeIn();
                $('.listaclave_empleado').html(data);
              }
            });
          }
      });

      $(document).on('click','#empleado',function(){
        let infoempleado = $(this).text();
        let empleado_nombre = infoempleado.substring(4);
        let empleado_clave = infoempleado.substring(0,4);
        $('.clave_empledo').val(empleado_clave);
        $('.listaclave_empleado').fadeOut();
        $('.nombre_empleado').val(empleado_nombre);
      });

      $('#importePrestamo').change(function(){
        let importe = $(this).val();
        let monto = $('#montoPrestamo').val();
        $('#cantidadPrestamo').val((monto/importe).toFixed(2));
      });

      $('#montoPrestamo').change(function(){
        let monto = $(this).val();
        let importe = $('#importePrestamo').val();
        $('#cantidadPrestamo').val((monto/importe).toFixed(2));
      });

      $(document).ready(function(){
        let i = 1;
        $('#agregarPrestamo').click(function(e){
          i++;
          e.preventDefault();
          let clave_empledo = $('#clave_empledo').val();
          let empleado = $('#nombre_empleado').val();
          let concepto = $('#concepto_clave').val();
          let nomConcepto = $('#nomConcepto').val();
          let cantidad = $('#cantidadPrestamo').val();
          let importe = $('#importePrestamo').val();
          let monto = $('#montoPrestamo').val();

          if(clave_empledo!="" && cantidad!="" && importe!="" && monto!=""){
            let htmlTags = '<tr>'+
                              '<td style="width: 60px;" class="empleado">' + clave_empledo + '</td>'+
                              '<td>' + empleado + '</td>'+
                              '<td style="width: 60px;" class="clvConcepto">' + concepto + '</td>'+
                              '<td>' + nomConcepto + '</td>'+
                              '<td style="width: 40px;" class="monto">' + monto + '</td>'+
                              '<td style="width: 40px;" class="importe">' + importe + '</td>'+
                              '<td style="width: 40px;" class="cantidad">' + cantidad + '</td>'+
                              '<td style="text-align: center; width: 40px; height: 25px;"><button class="borrar" type="button" style="width:30px; height:25px"><i class="far fa-trash-alt"></i></button></td>'+
                            '</tr>'
            $('#example12 tbody').append(htmlTags);
            $('input[type="text"]').val('');
            $('input[type="number"]').val('');
          }else{
            alert("Falta información");
          }
        });
      });

      $('#finalizarPrestamo').click(function (e){
        let myTableArray = [];
        document.querySelectorAll('.example12 tbody tr').forEach(function(e){
          let fila = {
            empleado: e.querySelector('.empleado').innerText,
            clvConcepto: e.querySelector('.clvConcepto').innerText,
            cantidad: e.querySelector('.cantidad').innerText,
            importe: e.querySelector('.importe').innerText,
            monto: e.querySelector('.monto').innerText
          };
          myTableArray.push(fila);
        });
        let jsonString = JSON.stringify(myTableArray);
        $.ajax({
          url: "{{ route('prestamos.store') }}",
          method: "POST",
          data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            info : jsonString,
          },
          success: function(data){
            console.log(data);
            $(".example12 tbody tr").closest('tr').remove();
          },
          error: function(xhr, status, error) {
            let err = JSON.parse(xhr.responseText);
            console.log(err.Message);
          }
        });
      });
    </script>