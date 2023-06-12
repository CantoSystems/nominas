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
    <link rel="stylesheet" href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/Admin/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('estilos-personalizados/estilos.css')}}">
</head>

<body>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"></div>
                </li>
                <li class="nav-item dropdown"></li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary bg-gray elevation-4">
            <a href="#" class="brand-link ">
                <img src="{{ asset('/Admin/dist/img/logo.png')}}" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">CDB | Nominas</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/Admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <p href="#" class="d-block">{{ auth()->user()->nombre }}
                            {{ auth()->user()->apellido_paterno }}
                        </p>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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
                        <li class="nav-item {{!Route::is('infonavit.acciones') ?: 'activo'}}">
                            <a href="{{ route('infonavit.acciones')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Tabla UMI (Infonavit)
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
                        <li class="nav-item {{!Route::is('fiscal') ?: 'activo'}}">
                            <a href="{{ route('fiscal')}}" class="nav-link">
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
                            <div class="info"></div>
                        </div>
                        <div class="sidebar">
                            <hr>
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="info">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i>
                                        {{ __('Cerrar sesión') }}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none; text-align: center;">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid"></div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <footer class="main-footer">
            <strong>Canto Contadores &copy; 1989-2023</strong>
        </footer>
    </div>
    <script src="{{ asset('/Admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/Admin/dist/js/adminlte.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
    $(document).ready(function() {
        //función de los botones de los catalogos globales
        //Acción nuevo registro
        $('.clv_imss').hide();
        $('#finPeriodo').hide();
        $('#pagoPeriodo').hide();
        $('#periodoDias').hide();
        $('#periodoInicio').hide();
        $(function() {
            $('#nuevo').click(function() {
                $('#actualizar_reg').hide();
                $('#buscar').attr("disabled", true);
                $('#nuevo_reg').show();
                $('.clv_imss').show();
                $('#cancelar_reg').attr("disabled", false);
                $('input[type="text"]').val('');
                $('input[type="email"]').val('');
                $('input[type="password"]').val('');
                $('input[type="number"]').val('');
                $('#basesalarial').find('option:first').attr('selected', 'selected').parent(
                    'select');
                $('#primero').attr("disabled", true);
                $('#atras').attr("disabled", true);
                $('#siguiente').attr("disabled", true);
                $('#ultimo').attr("disabled", true);
                $('#actualizar').attr("disabled", true);
                $('.porcentajeAhorro').val("0");
                $('.primaRiesgo').val("0");
                $('#eliminar').addClass("not-active");
                $('#guardar_falso').hide();
                $('#contra').removeAttr("readOnly");
                $('#contra1').removeAttr("readOnly");
                $('#for_roles').hide();
                $('#periodoDias').show();
                $('#periodoInicio').show();
                $('.inicioPeriodo').attr("disabled", true);
            });
            //Acción al actualizar el registro
            $('#actualizar').click(function() {
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
        //Funcion autocomplementado de regimen para empresas
        //Llenado del listado de la consulta de Regimen
        $('.obtenerRegimen').keyup(function() {
            let consulta = $(this).val();
            //console.log(consulta);
            if (consulta != '') {
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('regimen.autocomplete') }}",
                    method: "POST",
                    data: {
                        consulta: consulta,
                        _token: _token
                    },
                    success: function(data) {
                        //console.log(data);
                        let tagRegimen;
                        $.each(data, function(index) {
                            tagRegimen =
                                '<ul class="dropdpwn-menu" aria-labelledby="dropdownMenuLink" style="display:block; position:relative;">' +
                                '<li class="desplegarRegimen" style="list-style:none">' +
                                '<a class="dropdown-item" href="#">' +
                                data[index].claveRegimen +
                                '&nbsp;' + data[index].descripcionRegimen +
                                '&nbsp;' +
                                '</a>' + '</li>';
                            $('#listadoRegimen').fadeIn();
                            $('#listadoRegimen').append(tagRegimen);
                        });
                    }
                });
            }
        });
        $(document).on('click', '.desplegarRegimen', function() {
            let infoRegimen = $(this).text();
            //console.log(infoRegimen);
            let fiscalClave = infoRegimen.substring(0, 3);
            let fiscalDescripcion = infoRegimen.substring(4, 100);
            console.log(fiscalDescripcion);
            $('.obtenerRegimen').val(fiscalDescripcion);
            $('.idRegimen').val(fiscalClave);
            $('#listadoRegimen').fadeOut();
        });
        $('.tagperiodo').keyup(function() {
            let valorPeriodo = $(this).val();
            if (valorPeriodo != 0) {
                $('.inicioPeriodo').attr("disabled", false);
                $('#fechafin').attr("disabled", true);
                $('#pagoPeriodo').attr("disabled", false);
                $('fechafin').prop("required", true);
                $('fechapago').prop("required", true);
                if (valorPeriodo == 10 || valorPeriodo == 7) {
                    $('#finPeriodo').show();
                    $('#pagoPeriodo').show();
                } else {
                    $('#finPeriodo').hide();
                    $('#pagoPeriodo').hide();
                }
            } else {
                $('.inicioPeriodo').attr("disabled", true);
                $('.inicioPeriodo').val('');
                $('#finPeriodo').attr("disabled", false);
                $('#fechafin').val('');
                $('#pagoPeriodo').attr("disabled", false);
                $('#fechapago').val('');
            }
        });

        $('.inicioPeriodo').change(function() {
            let inicio = $(this).val();
            let periodoTipo = $('.tagperiodo').val();
            $.ajax({
                url: "{{ route('nominas.fechaFin') }}",
                method: "GET",
                data: {
                    inicio,
                    periodoTipo
                },
                success: function(data) {
                    console.log(data);
                    $('#fechafin').val(data);
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    console.log(err.Message);
                }
            });
        });
    });

    //Función para convertir en texto en mayusculas
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    $('.telefono').mask('(00) 0000-0000');

    $(document).on('change', '#prestacionIMSS', function(event) {
        if (($("#seguroIMSS option:selected").val() == "Enfermedades y Maternidad") && ($(
                "#prestacionIMSS option:selected").val() == "En especie")) {
            $("#cuotapatron2").prop("disabled", false);
            console.log("Primero");
        } else {
            $("#cuotapatron2").prop("disabled", true);
            console.log("Segundo");
        }
    });

    $(document).on('change', '#seguroIMSS', function(event) {
        if (($("#seguroIMSS option:selected").val() == "Enfermedades y Maternidad") && ($(
                "#prestacionIMSS option:selected").val() == "En especie")) {
            $("#cuotapatron2").prop("disabled", false);
            console.log("Tercero");
        } else {
            $("#cuotapatron2").prop("disabled", true);
            console.log("Cuarto");
        }
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false
        });
        $("#fiscal").DataTable({
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

    <script type="text/javascript">
    //Permite solo caracteres excluyendo números
    function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8) return true;
        patron = /[A-Za-z\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }

    //Permite solo nuemeros excluyendo caracteres
    function numeros(event) {
        if (event.charCode >= 48 && event.charCode <= 57) {
            return true;
        }
        return false;
    }
    </script>
</body>

</html>