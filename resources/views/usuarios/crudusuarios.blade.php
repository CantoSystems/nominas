@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <!-- Inicio Datatables-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Nombre del Role</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data_user as $data)
                            <tr>
                                <th scope="row">{{$data->name}}</th>
                                <td>{{$data->email}}</td>
                                <td>{{$data->nombre_rol}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
         <!--Fin Datatables-->

         <!--Sección botones y direcciones-->
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios</h3>
                </div>
            <div class="card-body">
                <form action="" method="GET" autocomplete="off">
                        <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label>Nombre del Usuario:</label>
                                    <input type="hidden" name="id" value="{{$usuarios->id}}">
                                    <input type="text" name="name"  value="{{$usuarios->name}}" class="form-control"  onkeyup="mayus(this);">

                              </div>
                          </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Correo electronico:</label>
                                    <input type="text" name="email"  value="{{$usuarios->email}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contraseña:</label>
                                    <input type="password" id="contra" name="password"  
                                    value="{{$usuarios->password}}" readonly  class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirmar contraseña:</label>
                                    <input type="password" readonly id="contra1" name="password_confirmation"  value="{{$usuarios->password}}"   class="form-control"  onkeyup="mayus(this)"; onkeypress="return validar(event)" >
                                </div>
                            </div>

                            <div class="col-sm-12">

                                <div class="form-group">
                                     <label>Asigne un rol: 
                                        </label>
                                    <select  class="custom-select" name="">
                                        <option id="for_roles">
                                            {{ $usuarios->nombre_rol}}
                                        </option>

                                        <option  value="null" style="text-align: center;">
                                            -------- 
                                            Seleccione una opción 
                                             --------
                                        </option>
                                @foreach($roles as $role)
                                        <option  value="{{$role->id}}"> {{$role->nombre_rol}}</option>
                                @endforeach
                                     </select>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="card-body">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <div class="form-group">
                                                <button type="submit"  name="acciones" value="primero" id="primero" style='width:40px; height:27px'><i class="fas fa-backward" ></i></button>
                                            </div>
                                            <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras" style='width:40px; height:27px'><i class="fas fa-arrow-circle-left"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:40px; height:27px'><i class="fas fa-arrow-circle-right"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:40px; height:27px'><i class="fas fa-forward"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="card-body">
                                    <div class="margin">
                                        <div class="btn-group">
                                            <div class="form-group">
                                                <button id="buscar" type="button" data-toggle="modal" data-target="#exampleModal" style='width:40px; height:27px'>
                                                    <i class="fas fa-search"></i>
                                                  </button>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="nuevo" style='width:40px; height:27px'> <i class="fas fa-user-plus"></i></button>
                                            </div>
                                            <div class="form-group">
                                             <button type="button" id="actualizar" style='width:40px; height:27px'> <i class="fas fa-pen-square"></i></button>
                                            </div>
                                            <div class="form-group">
                                            <a id="eliminar" data-target="#delete" data-toggle="modal">
                                            <button type="button" style='width:40px; height:27px'>
                                            <i class="far fa-trash-alt">
                                            </i>
                                            </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">

                                       <button id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>


                                </div>
                                <div class="form-group">
                                    <button name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:40px; height:27px'"><i class="fas fa-save"></i></button>
                                </div>

                                <div class="form-group">
                                    <button name="acciones" value="cancelar_banco" id="cancelar_reg" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                </div>

                                <div class="form-group">
                                    <button name="acciones" value="cancelar_actualiza" id="cancelar_actual" type="submit" style="display: none;width:40px; height:28px"><i class="far fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>
                    </form>
                    @include('usuarios.modaldeleteusuarios')
                    @include('usuarios.modalsearchusuarios')
                     
                
                   </div>
                   </div>
        </div>
    </div>
</div>

</div>


@endsection
