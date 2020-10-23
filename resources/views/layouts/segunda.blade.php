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
  <link rel="stylesheet" href="../Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../Admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../Admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../Admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
      <!-- Sidebar user panel (optional) -->
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catalogos
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
                    <p>Areas</p>
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
                  <a href="{{ route('home')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cambiar empresa</p>
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
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('/Admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/Admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="../Admin/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="../Admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../Admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../Admin/plugins/moment/moment.min.js"></script>
<script src="../Admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../Admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../Admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../Admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

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
    });
    $('#nuevomodal').click(function(){
      $('#nuevo_regmodal').show();
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
  //validar los input de porcentaje en beneficiarios en el 
  //catalogo de empleados
  let porcentaje = document.getElementById('porcentaje');
  let porcentaje1 = document.getElementById('porcentaje1');
  let porcentaje2 = document.getElementById('porcentaje2');
  let porcentaje3 = document.getElementById('porcentaje3');
  let porcentaje4 = document.getElementById('porcentaje4');
  let mensaje = document.getElementById('mensaje');
  console.log(porcentaje.value);

  porcentaje1.addEventListener('keyup', ()=>{
    let sumavalores = parseInt(porcentaje.value) + parseInt(porcentaje1.value);
    console.log(sumavalores);
    if (sumavalores > 100) {
      porcentaje2.disabled = true;
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      porcentaje2.value = '';
      porcentaje3.value = '';
      porcentaje4.value = '';
      mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
    }else if(sumavalores === 100){
      porcentaje2.disabled = true;
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      porcentaje2.value = '';
      porcentaje3.value = '';
      porcentaje4.value = '';
      mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';

    }
  })

  porcentaje2.addEventListener('keyup', ()=>{
    let sumatotal = parseInt(porcentaje.value) + parseInt(porcentaje1.value) + parseInt(porcentaje2.value);
    console.log(sumatotal);
    if (sumatotal > 100) {
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      porcentaje3.value = '';
      porcentaje4.value = '';
      mensaje.innerHTML = 'Corregir en caso de agregar un nuevo porcentaje, no pueden exceder a 100';
    }else if (sumatotal === 100){
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      porcentaje3.value = '';
      porcentaje4.value = '';
      mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';

    }
  })

  porcentaje3.addEventListener('keyup', ()=>{
    let suma = parseInt(porcentaje.value) + parseInt(porcentaje1.value) + parseInt(porcentaje2.value)+parseInt(porcentaje3.value);
    console.log(suma);
    if (suma > 100) {
      porcentaje4.disabled = true;
      porcentaje4.value = '';
      mensaje.innerHTML = 'Corregir en caso de agregar un nuevo porcentaje, no pueden exceder a 100';
    }else if(suma === 100){
      porcentaje4.disabled = true;
      porcentaje4.value = '';
      mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';
    }
  })

</script>


</body>
</html>
