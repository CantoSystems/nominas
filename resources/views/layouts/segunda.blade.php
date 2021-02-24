<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CDB | Nominas</title>
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('../Admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/Admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Jquery UI-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.css')}}">
  <style type="text/css">
    .form-control-nueva{
      border:0;
      width: 6em;
      opacity: 0.9;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


    </ul>

    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-gray elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/Admin/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CDB Nominas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-list-ul"></i>
              <p>
                Catálogos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('empleados.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empleados</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('conceptos.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Conceptos</p>
                </a>
              </li> 
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('areas.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Áreas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('departamentos.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departamentos</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('puestos.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Puestos</p>
                </a>
              </li> 
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('periodos.acciones')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Periodos</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('prestaciones.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prestaciones</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('home')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cambiar empresa</p>
                </a>
              </li>  
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Incidencias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ausentismo.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ausentismo</p>
                </a>
              </li>
            </ul>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('horasextras.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Horas extras</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('tiempo.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('home')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Incidencias</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Canto Contadores &copy; 1989-2020</strong>
  </footer>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('/Admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/Admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/Admin/dist/js/demo.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('/Admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('/Admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('/Admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/Admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('/Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('/Admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('/Admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
  //funcionaiento del datarange de los input tipo fecha
  //se encuentran en modal empleados
  $(function(){
    $('#duracion').daterangepicker()
    $('#duracion2').daterangepicker()
    $('#duracion3').daterangepicker()
    $('#duracion4').daterangepicker()
    $('#duracion5').daterangepicker()
    $('#duracion6').daterangepicker()
    $('#duracion7').daterangepicker()
    $('#duracion8').daterangepicker()
    $('#duracion9').daterangepicker()
  });
</script>

<script>
  //Funcionamiento de los botones de los catalogos Actualizar y registrar
  $(function(){
    $('#nuevo').click(function(){
      $('#actualizar_reg').hide();
      $('#buscar').hide();
      $('#nuevo_reg').show();
      $('#cancelar_reg').show();
      $('input[type="text"]').val('');
      $('input[type="date"]').val('');
      $('input[type="number"]').val('');
      $("input:checkbox").removeAttr("checked");
      $("#naturaleza > option[value=1]").attr("selected",true);
      $("#manejo > option[value=1]").attr("selected",true);
      $('#primero').hide();
      $('#atras').hide();
      $('#siguiente').hide();
      $('#ultimo').hide();
      $('#principal').hide();
      $('#opcion').show();
      $("#areas > option[value=1]").attr("selected",true);
      $('#first_areas').hide();
      $('#actualizar').hide();
      $('#eliminar').hide();
      $('#buscar').hide();
    });
    $('#actualizar').click(function(){
      $('#nuevo_reg').hide();
    $('#actualizar_reg').show();
    $('#cancelar_reg').show();
    $('#primero').hide();
    $('#atras').hide();
    $('#siguiente').hide();
    $('#ultimo').hide();
    $('#nuevo').hide();
    $('#eliminar').hide();
    $('#buscar').hide();
    });
    $('.actualizarporid').click(function(){
      $('.prueba').modal('show');
      $('.cancelar_actualizar').modal('show');
    });
  })
</script>
<script>
  //Funcionamiento de los datatables de los catalogos, de empresas
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

  <!--CDN para el funcionamiento de la mascara de los telefonos del catalogo de empleado-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono_referencia').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono_referencia1').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono_referencia2').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono_empleado').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono_compania').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono1').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono2').mask('(00) 0000-0000');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $('.telefono3').mask('(00) 0000-0000');
</script>
<script>
  //Funcionamiento convertir texto en mayusculas
  function mayus(e) {
    e.value = e.value.toUpperCase();
}

</script>
<script type="text/javascript">
  //Validar solo ingresen texto
  function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return true;
  patron =/[A-Za-z\s]/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
  }
</script>

<script type="text/javascript">
  //validar tipo de sangre
  function validasangre(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return true;
  patron =/[A-Za-z-+\s]/;
  te = String.fromCharCode(tecla);
  return patron.test(te);
  }
</script>

<script type="text/javascript">
  //validar solo números
function numeros(event) {
if(event.charCode >=48 && event.charCode <=57 ){
  return true;
}
return false;
}
</script>

<script>
  $(document).ready(function(){ 
    $('.clave_empledo').keyup(function(){
      let query = $(this).val();  

        if(query != '')
        {
          let _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{ route('ausentismo.mostrarempleado') }}",
            method: "POST",
            data:{query:query,_token:_token},
            success:function(data)
            {
              $('.listaclave_empleado').fadeIn();
              $('.listaclave_empleado').html(data);
            //console.log(data);
            }
            
          });
        }
    });

    $(document).on('click','#empleado',function(){
      let infoempleado = $(this).text();
      let empleado_nombre = infoempleado.substring(4);
      let empleado_clave = infoempleado.substring(0,4);
      //console.log(empleado_clave);
      //console.log(infoempleado);
      $('.clave_empledo').val(empleado_clave);
      $('.listaclave_empleado').fadeOut();
      $('.nombre_empleado').val(empleado_nombre);
    
    });

  });
</script>
<script>
  $(document).ready(function(){ 
    $('#concepto_clave').keyup(function(){
      let consulta = $(this).val();  
        if(consulta != '')
        {
          let _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{ route('ausentismo.mostrarconcepto') }}",
            method: "POST",
            data:{consulta:consulta,_token:_token},
            success:function(data)
            {
              $('#listaconcepto_clave').fadeIn();
              $('#listaconcepto_clave').html(data);
            }

          });
           //console.log(data);
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

  });
</script>
<script>
  $(document).ready(function(){
    let i = 1;
    $('#agregar').click(function(e){
      i++;
		  e.preventDefault();
      let periodoID = $('#periodoID').val();
      let clave_empledo = $('#clave_empledo').val();
      let nombre = $('#nombre').val();
      let cantidad_tiempo = $('#cantidad_tiempo').val();
      let fecha_extra = $('#fecha_extra').val();
      let htmlTags = '<tr>'+
                        '<td class="periodo">' + periodoID + '</td>'+
                        '<td class="empleado">' + clave_empledo + '</td>'+
                        '<td class="cantidad">' + cantidad_tiempo + '</td>'+
                        '<td class="fecha">' + fecha_extra + '</td>'+
                      '</tr>'
      $('#example12 tbody').append(htmlTags);
      $('input[type="text"]').val('');
      $('input[type="date"]').val('');
      $('input[type="number"]').val('');
    });
  });

  $('#finalizar').click(function (e){
    let myTableArray = [];
    document.querySelectorAll('.example12 tbody tr').forEach(function(e){
      let fila = {
        periodo: e.querySelector('.periodo').innerText,
        empleado: e.querySelector('.empleado').innerText,
        cantidad: e.querySelector('.cantidad').innerText,
        fecha: e.querySelector('.fecha').innerText
      };
      myTableArray.push(fila);

    });
   let jsonString = JSON.stringify(myTableArray);
   $.ajax({
      url: "{{ route('tiempo.store') }}",
      method: "POST",
      data: {
        _token: $("meta[name='csrf-token']").attr("content"),
        info : jsonString,
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

</body>
</html>
