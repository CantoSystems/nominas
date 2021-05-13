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
  <link rel="stylesheet" href="{{ asset('estilos-personalizados/plantillados.css')}}">
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
    <ul class="navbar-nav ml-auto"></ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-gray elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('/Admin/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Session::get('empresa') }} <br>
      </span>
    </a>
    <center>
           <a href="{{ route('home')}}" class="nav-link">
                <i class="fas fa-external-link-alt"></i>
                  Cambiar empresa
                </a>
        </center>

    <!-- Sidebar -->
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
            <!--<ul class="nav nav-treeview">
              <li class="nav-item {{!Route::is('empleados.index') ?: 'active'}}">
                <a href="{{ route('empleados.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empleados</p>
                </a>
              </li>
            </ul>-->
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
          </li>
        
        <!---->
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Nómina
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{!Route::is('prenomina.index') ?: 'active'}}">
                <a name="botonNominas" id="botonNominas" href="{{ route('prenomina.index')}}" class="nav-link active">
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
          </li>
        </ul>
      </nav>
    </div>
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
</div>

</body>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Canto Contadores &copy; 1989-2020</strong>
  </footer>
<!-- ./wrapper -->
</html>
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
  $(document).on('click', 'ul li', function(){
    //e.preventDefault();
    $(this).addClass('activo').siblings().removeClass('activo')
  });
</script>

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
      $('#guardar_falso').hide();
      $('#buscar').attr("disabled", true);
      $('#nuevo_reg').show();
      $('#cancelar_reg').attr("disabled", false);
      $('input[type="text"]').val('');
      $('input[type="date"]').val('');
      $('input[type="number"]').val('');
      $("input:checkbox").removeAttr("checked");
      $("#naturaleza > option[value=1]").attr("selected",true);
      $("#manejo > option[value=1]").attr("selected",true);
      $('#primero').attr("disabled", true);
      $('#atras').attr("disabled", true);
      $('#siguiente').attr("disabled", true);
      $('#ultimo').attr("disabled", true);
      $('#principal').attr("disabled", true);
      $('#opcion').show();
      $("#areas > option[value=1]").attr("selected",true);
      $('#first_areas').hide();
      $('#actualizar').attr("disabled", true);
      $('#eliminar').addClass("not-active");
      $('#buscar').attr("disabled", true);
    });
    $('#actualizar').click(function(){
      $('#nuevo_reg').attr("disabled", true);
      $('#actualizar_reg').show();
      $('#guardar_falso').hide();
      $('#cancelar_reg').attr("disabled", false);
      $('#primero').attr("disabled", true);
      $('#atras').attr("disabled", true);
      $('#siguiente').attr("disabled", true);
      $('#ultimo').attr("disabled", true);
      $('#nuevo').attr("disabled", true);
      $('#eliminar').addClass("not-active");
      $('#buscar').attr("disabled", true);
    });
    $('.actualizarporid').click(function(){
      $('.prueba').attr("disabled", false)
      $('.actualizarporid').attr("disabled", true);
      $('#primero').attr("disabled", true);
      $('#atras').attr("disabled", true);
      $('#siguiente').attr("disabled", true);
      $('#ultimo').attr("disabled", true);
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

<!-- Scripts para Autocomplete empleados y conceptos -->
<script>
  $(document).ready(function(){ 
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
  });
</script>
<script>
  $(document).ready(function(){ 
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
  });
</script>

<!--Funcionamiento de Ausentismo-->
<script>
  $(document).on('click', '.borrar_ausencia', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    let fecha = new Date(); //Fecha actual
    let mes = fecha.getMonth()+1; //obteniendo mes
    let dia = fecha.getDate()-1; //obteniendo dia
    let ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('fecha_ausentismo').value=ano+"-"+mes+"-"+dia;
  });

 $(document).ready(function(){
    let i = 1;
    $('#agregar_ausencia').click(function(e){
      i++;
      e.preventDefault();
      let clave_empledo = $('#clave_empledo').val();
      let nombre = $('#nombre').val();
      let cantidad_ausentismo = $('#cantidad_ausentismo').val();
      let concepto_clave = $('#concepto_clave').val();
      let fecha_ausentismo = $('#fecha_ausentismo').val();
      fecha_ausentismo = fecha_ausentismo.split("-").reverse().join("/");
      let incapacidad_ausencia = $('#incapacidad_ausencia').val();
      let descripcion = $('#descripcion').val();

      if(clave_empledo!="" && nombre!="" && cantidad_ausentismo!="" && concepto_clave!="" && fecha_ausentismo!="" && descripcion!=""){
        let htmlTags = '<tr>'+
                          '<td class="empleado">' + clave_empledo + '</td>'+
                          '<td class="ausentismo">' + cantidad_ausentismo + '</td>'+
                          '<td class="concepto">' + concepto_clave + '</td>'+
                          '<td class="fecha">' + fecha_ausentismo + '</td>'+
                          '<td class="incapacidad">' + incapacidad_ausencia + '</td>'+
                          '<td class="descripcion">' + descripcion + '</td>'+
                          '<td class="elimina" style="text-align: center; width:40px; height:25px;"><button class="borrar_ausencia" type="button" style="width:40px; height:25px"><i class="far fa-trash-alt"></i></button></td>'+
                        '</tr>'
        $('#example13 tbody').append(htmlTags);
        $('input[type="text"]').val('');
        $('input[type="date"]').val('');
        $('input[type="number"]').val('');
        let fecha = new Date(); //Fecha actual
        let mes = fecha.getMonth()+1; //obteniendo mes
        let dia = fecha.getDate()-1; //obteniendo dia
        let ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_ausentismo').value=ano+"-"+mes+"-"+dia;
      }else{
        alert("Falta información");
      }
    });
  }); 

 $('#finalizar_ausencia').click(function (e){
    let myTableArrayAusencia = [];
    document.querySelectorAll('.example13 tbody tr').forEach(function(e){
      let filas = {
        empleado: e.querySelector('.empleado').innerText,
        ausentismo: e.querySelector('.ausentismo').innerText,
        concepto: e.querySelector('.concepto').innerText,
        fecha: e.querySelector('.fecha').innerText.split("/").reverse().join("-"),
        incapacidad: e.querySelector('.incapacidad').innerText,
        descripcion: e.querySelector('.descripcion').innerText
      };
      myTableArrayAusencia.push(filas);

    });
    let jsonStringa = JSON.stringify(myTableArrayAusencia);
   $.ajax({
      url: "{{ route('ausencia.store') }}",
      method: "POST",
      data: {
        _token: $("meta[name='csrf-token']").attr("content"),
        info : jsonStringa,
      },
      success: function(data){
        console.log(data);
        $(".example13 tbody tr").closest('tr').remove();
      },
      error: function(xhr, status, error) {
        var err = JSON.parse(xhr.responseText);
        console.log(err.Message);
      }
    });
   console.log(myTableArrayAusencia);
  });
</script>

<!--Funcionamiento de Tiempo Extra-->
<script>
  $(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate()-1; //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('fecha_extra').value=ano+"-"+mes+"-"+dia;
  });

  $(document).ready(function(){
    let i = 1;
    $('#agregar').click(function(e){
      i++;
      e.preventDefault();
      let clave_empledo = $('#clave_empledo').val();
      let nombre = $('#nombre').val();
      let cantidad_tiempo = $('#cantidad_tiempo').val();
      let fecha_extra = $('#fecha_extra').val();
      fecha_extra = fecha_extra.split("-").reverse().join("/");

      if(clave_empledo!="" && nombre!="" && cantidad_tiempo!="" && fecha_extra!=""){
        let htmlTags = '<tr>'+
                          '<td class="empleado">' + clave_empledo + '</td>'+
                          '<td class="cantidad">' + cantidad_tiempo + '</td>'+
                          '<td class="fecha">' + fecha_extra + '</td>'+
                          '<td style="text-align: center; width:40px; height:25px;"><button class="borrar" type="button" style="width:40px; height:25px"><i class="far fa-trash-alt"></i></button></td>'+
                        '</tr>'
        $('#example12 tbody').append(htmlTags);
        $('input[type="text"]').val('');
        $('input[type="date"]').val('');
        $('input[type="number"]').val('');
        let fecha = new Date(); //Fecha actual
        let mes = fecha.getMonth()+1; //obteniendo mes
        let dia = fecha.getDate()-1; //obteniendo dia
        let ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_extra').value=ano+"-"+mes+"-"+dia;
      }else{
        alert("Falta información");
      }
    });
  });

  $('#finalizar').click(function (e){
    let myTableArray = [];
    document.querySelectorAll('.example12 tbody tr').forEach(function(e){
      let fila = {
        empleado: e.querySelector('.empleado').innerText,
        cantidad: e.querySelector('.cantidad').innerText,
        fecha: e.querySelector('.fecha').innerText.split("/").reverse().join("-")
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
        $(".example12 tbody tr").closest('tr').remove();
      },
      error: function(xhr, status, error) {
        var err = JSON.parse(xhr.responseText);
        console.log(err.Message);
      }
    });
  });
</script>

<!--Script para incidencias-->
<script>
  $(document).ready(function(){
    let i = 1;
    $('#agregarIncidencia').click(function(e){
      i++;
      e.preventDefault();
      let clave_empledo = $('#clave_empledo').val();
      let concepto_clave = $('#concepto_clave').val();
      let cantidad = $('#cantidad').val();
      let importe = $('#importe').val();
      let monto = $('#monto').val();

      if(clave_empledo!="" && concepto_clave!="" && cantidad!="" && importe!="" && monto!=""){
        let htmlTags = '<tr>'+
                          '<td class="empleado">' + clave_empledo + '</td>'+
                          '<td class="concepto">' + concepto_clave + '</td>'+
                          '<td class="cantidad">' + cantidad + '</td>'+
                          '<td class="importe">' + importe + '</td>'+
                          '<td class="monto">' + monto + '</td>'+
                          '<td style="text-align: center; width:40px; height:25px;"><button class="borrar" type="button" style="width:30px; height:25px"><i class="far fa-trash-alt"></i></button></td>'+
                        '</tr>'
        $('#example12 tbody').append(htmlTags);
        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
      }else{
        alert("Falta información");
      }
    });
  });

  $('#finalizarIncidencia').click(function (e){
    let myTableArray = [];
    document.querySelectorAll('.example12 tbody tr').forEach(function(e){
      let fila = {
        empleado: e.querySelector('.empleado').innerText,
        concepto: e.querySelector('.concepto').innerText,
        cantidad: e.querySelector('.cantidad').innerText,
        importe: e.querySelector('.importe').innerText,
        monto: e.querySelector('.monto').innerText
      };
      myTableArray.push(fila);
    });
    let jsonString = JSON.stringify(myTableArray);
    $.ajax({
      url: "{{ route('incidencias.store') }}",
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
        var err = JSON.parse(xhr.responseText);
        console.log(err.Message);
      }
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('.extraer_id').click(function(e){
      var id_empleado = $(".identificador_prenomina",this).val();
      var percepciones = 0, deducciones = 0, total = 0, impuestosTrabajador = 0, impuestosPatron = 0, total2 = 0;

      $.ajax({
        url: "{{ route('prenomina.create') }}",
        method: "GET",
        data: {
          _token: $("meta[name='csrf-token']").attr("content"),
          info : id_empleado,
        },
        success: function(data){
          $.each(data, function(index, row){
            if(row.clave.includes('P')){
              percepciones = percepciones + row.resultado;
              $('.percepciones').append('<tr><td style="vertical-align: middle;">'+row.clave+'</td><td style="vertical-align: middle;">'+row.concepto+'</td><td><input type="text" class="form-control" name="'+row.clave+'" value="'+row.resultado+'" /></td></tr>');
            }else if(row.clave.includes('D')){
              deducciones = deducciones + row.resultado;
              $('.deducciones').append('<tr><td style="vertical-align: middle;">'+row.clave+'</td><td style="vertical-align: middle;">'+row.concepto+'</td><td><input type="text" class="form-control" name="'+row.clave+'" value="'+row.resultado+'" /></td></tr>');
            }else if(row.clave.includes('I')){
              impuestosTrabajador = impuestosTrabajador + row.resultado;
              $('.impuestosTrabajador').append('<tr><td style="vertical-align: middle;">'+row.clave+'</td><td style="vertical-align: middle;">'+row.concepto+'</td><td><input type="text" class="form-control" name="'+row.clave+'" value="'+row.resultado+'" /></td></tr>');
            }else if(row.clave.includes('P')){
              impuestosPatron = impuestosPatron + row.resultado;
              $('.impuestosPatron').append('<tr><td style="vertical-align: middle;">'+row.clave+'</td><td style="vertical-align: middle;">'+row.concepto+'</td><td><input type="text" class="form-control" name="'+row.clave+'" value="'+row.resultado+'" /></td></tr>');
            }
          });

          total = percepciones - deducciones - impuestosTrabajador;
          total2 = total - impuestosPatron;
          $('.totalPercepcion').append('<tr><td colspan="2" style="vertical-align: middle;">Total:</td><td style="vertical-align: middle;">'+percepciones+'</td></tr>');
          $('.totalDeduccion').append('<tr><td colspan="2" style="vertical-align: middle;">Total:</td><td style="vertical-align: middle;">'+deducciones+'</td></tr>');
          $('.totalTrabajador').append('<tr><td colspan="2" style="vertical-align: middle;">Total:</td><td style="vertical-align: middle;">'+total+'</td></tr>');
          $('.totalPatron').append('<tr><td colspan="2" style="vertical-align: middle;">Total:</td><td style="vertical-align: middle;">'+total2+'</td></tr>');
        },
        error: function(xhr, status, error) {
          var err = JSON.parse(xhr.responseText);
          console.log(err.Message);
        }
      });
    });

    $('.modal').on('hidden.bs.modal', function(){
      $('.percepciones2 tbody tr').closest('tr').remove();
      $('.deducciones2 tbody tr').closest('tr').remove();
      $('.impuestosTrabajador2 tbody tr').closest('tr').remove();
      $('.impuestosPatron2 tbody tr').closest('tr').remove();
      $('.totalPercepcion2 tbody tr').closest('tr').remove();
      $('.totalDeduccion2 tbody tr').closest('tr').remove();
      $('.totalTrabajador2 tbody tr').closest('tr').remove();
      $('.totalPatron2 tbody tr').closest('tr').remove();
    });
  });
</script>
</body>
</html>