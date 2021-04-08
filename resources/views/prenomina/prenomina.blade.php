@extends('layouts.segunda')
@section('content')
<div class="container">
    <div class="col">
                 <!-- Inicio Datatables-->
        <div class="row">
            <div class="col">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                       Cálculo de prenomina
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Puesto 
                                    <th>Departamento</th>
                                    <th>Área</th>
                                    <th></th>
                            </tr>
                        </thead>
                        <tbody>
                             
                            
                     
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
