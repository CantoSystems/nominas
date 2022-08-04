@extends('layouts.principal')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabla Infonavit (UMI)</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Año</th>
                                <th style="text-align: center;">Valor Veces Salario Mínimo</th>
                                <th style="text-align: center;">Valor % UMA</th>
                                <th style="text-align: center;">Valor Unidad Mixta Infonavit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($infonavitGral))
                            @foreach ($infonavitGral as $inf)
                            <tr>
                                <td style="text-align: center;" scope="row">{{ $inf->anio }}</td>
                                <td style="text-align: center;">{{ $inf->vsm }}</td>
                                <td style="text-align: center;">{{ $inf->varUma }}</td>
                                <td style="text-align: center;">{{ $inf->valorInfonavit }}</td>
                                <td>
                                    @canany(['administrador','capturista'])
                                    <div>
                                        <center>
                                            <a href="{{ route('infonavit.mostrar',$inf->id) }}">
                                                <button type="button" class="botones">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </a>
                                        </center>
                                    </div>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabla Infonavit (UMI)</h3>
                </div>
                <div class="card-body">
                    @if(session()->has('busqueda'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('busqueda')}}
                    </div>
                    @endif
                    @if(session()->has('msj'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('msj')}}
                    </div>
                    @endif
                    <form action="{{ route('infonavit.acciones')}}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Año:</label>
                                    @if(isset($infonavit))
                                    <input type="text" id="anioInfonavit" name="anioInfonavit" value="{{ $infonavit->anio }}"
                                        class="form-control">
                                    <input type="hidden" name="idInfonavit" name="idInfonavit" value="{{ $infonavit->id }}">
                                    @error('anio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="text" name="anioInfonavit" id="anioInfonavit" class="form-control">
                                    @error('anio')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Valor Veces Salario Mínimo:</label>
                                    @if(isset($infonavit))
                                    <input type="number" step=".01" id="vsmInfonavit" name="vsmInfonavit" value="{{ $infonavit->vsm }}"
                                        class="form-control">
                                    @error('vsm')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="number" step=".01" name="vsmInfonavit" id="vsmInfonavit" class="form-control">
                                    @error('vsm')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Var. % UMA:</label>
                                    @if(isset($infonavit))
                                    <input type="number" step=".01" id="varUma" name="varUma" value="{{ $infonavit->vsm }}"
                                        class="form-control">
                                    @error('varUma')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="number" step=".01" name="varUma" id="varUma" class="form-control">
                                    @error('varUma')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Valor Unidad Mixta Infonavit:</label>
                                    @if(isset($infonavit))
                                    <input type="number" step=".01" id="valorInfonavit" name="valorInfonavit" value="{{ $infonavit->valorInfonavit }}"
                                        class="form-control">
                                    @error('valorInfonavit')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="number" step=".01" name="valorInfonavit" id="valorInfonavit" class="form-control">
                                    @error('valorInfonavit')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Var % Unidad Mixta:</label>
                                    @if(isset($infonavit))
                                    <input type="number" step=".01" id="varUnidadMixta" name="varUnidadMixta" value="{{ $infonavit->varUnidadMixta }}"
                                        class="form-control">
                                    @error('varUnidadMixta')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @else
                                    <input type="number" step=".01" name="varUnidadMixta" id="varUnidadMixta" class="form-control">
                                    @error('varUnidadMixta')
                                    <div class="alert alert-secondary">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        @canany(['administrador','capturista','reportes'])
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @if(isset($infonavit))
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="primero" id="primero"
                                                class="botones"><i class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="atras" id="atras"
                                                class="botones"><i class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="siguiente" id="siguiente"
                                                class="botones"><i class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="acciones" value="ultimo" id="ultimo"
                                                class="botones"><i class="fas fa-forward"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-backward"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-left"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-arrow-circle-right"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="botones" disabled><i
                                                    class="fas fa-forward"></i></button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endcanany

                            <!---Operaciones-->
                            <div class="col-md-5">
                                <div class="margin">
                                    <div class="btn-group">
                                        @canany(['administrador','capturista','reportes'])
                                        @if(isset($infonavit))
                                        <div class="form-group">
                                            <button id="buscar" type="button" data-toggle="modal"
                                                data-target="#exampleModal" class="botones">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button id="buscar_falso" type="button" class="botones" disabled>
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @endif

                                        @endcanany
                                        @canany(['administrador','capturista'])
                                        <div class="form-group">
                                            <button type="button" id="nuevo" class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        @if(isset($infonavit))
                                        <div class="form-group">
                                            <button type="button" id="actualizar" class="botones"> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <button type="button" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endif
                                        @elsecanany(['reportes'])
                                        <div class="form-group">
                                            <button type="button" disabled class="botones"> <i
                                                    class="fas fa-user-plus"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="botones" disabled> <i
                                                    class="fas fa-pen-square"></i></button>
                                        </div>
                                        @endcanany
                                        @can('administrador')
                                        @if(isset($infonavit))
                                        <div class="form-group">
                                            <a id="eliminar" data-target="#modal-deleteInfonavit-{{$infonavit->id}}"
                                                data-toggle="modal">
                                                <button type="button" class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <a id="eliminar_vacio">
                                                <button type="button" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                        @elsecanany(['capturista','reportes'])
                                        <div class="form-group">
                                            <a id="eliminar_">
                                                <button type="button" disabled class="botones">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endcanany
                                    </div>
                                </div>
                            </div>

                            <!---Acciones-->
                            <div class="col-md-2">
                                <div class="margin">
                                    <div class="btn-group">
                                        <!--Su uso solo es para visualizar la existencia del los iconos -->
                                        <div class="form-group">
                                            <button id="guardar_falso" disabled class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button id="nuevo_reg" name="acciones" value="registrar" type="submit"
                                                class="botones" style="display: none;"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="actualizar" id="actualizar_reg" type="submit"
                                                style="display: none;" class="botones"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <button name="acciones" value="cancelar" id="cancelar_reg" type="submit"
                                                class="botones" disabled><i class="far fa-window-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @isset($infonavit)
                    @include('infonavit.modaldeleteinfonavit')
                    @endisset
                    @include('infonavit.modalsearchinfonavit')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection