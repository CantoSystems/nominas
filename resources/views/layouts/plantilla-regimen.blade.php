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

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/Admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('estilos-personalizados/estilos.css')}}">
</head>
<body>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-gray elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link ">
      <img src="{{ asset('/Admin/dist/img/logo.png')}}"  class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CDB | Nominas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/Admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->nombre }} {{ auth()->user()->apellido_paterno }}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
          <li class="nav-item {{!Route::is('nominas.empresas') ?: 'activo'}}">
            <a href="{{route('nominas.empresas')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Nóminas
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('home') ?: 'activo'}}">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Seleccionar Empresa
              </p>
            </a>
          </li>
           <!--<li class="nav-item">
            <a href="{{ route('prestaciones.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Prestaciones
              </p>
            </a>
          </li>-->
          <li class="nav-item {{!Route::is('bancos.acciones') ?: 'activo'}}">
            <a href="{{ route('bancos.acciones')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Bancos 
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('umas.index') ?: 'activo'}}">
            <a href="{{ route('umas.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                UMA
              </p>
            </a>
          </li>

          <li class="nav-item {{!Route::is('retenciones.index') ?: 'activo'}}">
            <a href="{{ route('retenciones.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tabla ISR
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('subsidio.acciones') ?: 'activo'}}">
            <a href="{{ route('subsidio.acciones')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tabla Subsidio
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('imss.acciones') ?: 'activo'}}">
            <a href="{{ route('imss.acciones')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tabla I.M.S.S
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('salariomin.acciones') ?: 'activo'}}">
            <a href="{{ route('salariomin.acciones')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tabla Salario Mínimo
              </p>
            </a>
          </li>
          <li class="nav-item {{!Route::is('regimen.index') ?: 'activo'}}">
            <a href="{{ route('regimen.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tabla Régimen Fiscal
              </p>
            </a>
          </li>
          @can('administrador')
            <li class="nav-item {{!Route::is('usuarios.index') ?: 'activo'}}">
              <a href="{{ route('usuarios.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
          @endcan
          <div class="sidebar">
            <div class="info">
              
            </div>
          </div>
          <div class="sidebar">
            <hr>
          <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="info">
                <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <!--<i class="nav-icon fas fa-th"></i>-->
               <i class="fas fa-power-off"></i>
              
                {{ __('Cerrar sesión') }}
                                               
              <form id="logout-form" action="{{ route('logout') }}" method="POST" 
              style="display: none; text-align: center;">
                @csrf
              </form>
            </a>

             </div>
          </div>

          <!--<li class="nav-item">
            <a href="{{ route('clasificacion.acciones')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clasificaciones
              </p>
            </a>
          </li>-->
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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
     
      
         
         @yield('content')

    </div>
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
    <!-- Default to the left -->
    <strong>Canto Contadores &copy; 1989-2020</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/Admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/Admin/dist/js/adminlte.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(document).ready(function(){
     //función de los botones de los catalogos globales
  //Acción nuevo registro
  $('.clv_imss').hide();

  $(function(){ 
          $('#nuevo').click(function(){
          $('#actualizar_reg').hide();
          $('#buscar').attr("disabled", true);
          $('#nuevo_reg').show();
          $('.clv_imss').show();
          $('#cancelar_reg').attr("disabled", false);
          $('input[type="text"]').val('');
          $('input[type="email"]').val('');
          $('input[type="password"]').val('');
          $('input[type="number"]').val('');
          $('#basesalarial').find('option:first').attr('selected', 'selected').parent('select');
          $('#primero').attr("disabled", true);
          $('#atras').attr("disabled", true);
          $('#siguiente').attr("disabled", true);
          $('#ultimo').attr("disabled", true);
          $('#actualizar').attr("disabled", true);
          $('.porcentajeAhorro').val("0");
          //$('#eliminar').attr("disabled","disabled");
          //$('#eliminar_falso').show();
          $('#eliminar').addClass("not-active");
          $('#guardar_falso').hide();
          $('#contra').removeAttr("readOnly");
          $('#contra1').removeAttr("readOnly");
          $('#for_roles').hide();
        });

          //Acción al actualizar el registro
          $('#actualizar').click(function(){
          $('#guardar_falso').hide();
          $('#cancelar_reg').attr("disabled", false);
          $('#nuevo_reg').hide();
          $('#actualizar_reg').show();
          $('#eliminar_falso').show();
          $('#primero').attr("disabled", true);
          $('#atras').attr("disabled", true);
          $('#siguiente').attr("disabled", true);
          $('#ultimo').attr("disabled", true);
          $('#nuevo').attr("disabled", true);
          $('#eliminar').addClass("not-active");
          $('#contra').hide();
          $('#contra1').hide();
          $('#for_roles').hide();
          $('#contra-label').hide();
          $('#contra1-label').hide();
          $('#buscar').attr("disabled", true);
        });
      })

  });
 
</script>
<script>
  //Función para convertir en texto en mayusculas
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script>
    $('.telefono').mask('(00) 0000-0000');
</script>

<script type="text/javascript">
  //Permite solo caracteres excluyendo números
  function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8) return true; 
    patron =/[A-Za-z\s]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
  }
</script>

<script type="text/javascript">
  //Permite solo nuemeros excluyendo caracteres
  function numeros(event) { 
    if(event.charCode >=48 && event.charCode <=57 ){
      return true;
    }
    return false;
  }
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false
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
<script>
    $(document).ready(function(){
        $('#nuevo_reg').click(function(e){
            e.preventDefault();
            let datosRegimen = {
                clave: $('#claveRegimen').val(),
                descripcion: $('#descripcionRegimen').val(),
            }
            console.log(datosRegimen);
            let jsonString = JSON.stringify(datosRegimen);
            console.log(jsonString);
            $.ajax({
                url: "{{ route('regimen.store') }}",
                method: "POST",
                data:{
                    _token: $("meta[name='csrf-token']").attr("content"),
                    info: jsonString,
                },
                success: function(data) {
                    console.log(data);
                    $('#claveRegimen').val(data.claveRegimen);
                    $('#descripcionRegimen').val(data.descripcionRegimen);
                    $('#nuevo_reg').hide();
                    $('#guardar_falso').show();
                    $('#guardar_falso').attr("disabled", true);

                },
                error:  function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                console.log(err.Message);
            }
            });
        });
       


    });
</script>
</body>
</html>
