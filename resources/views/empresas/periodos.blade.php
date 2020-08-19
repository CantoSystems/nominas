@extends('layouts.principal')

@section('content')
<div class="card">
    <div class="card-header">
      Periodos
    </div>
    <div class="card-body">
      <h5 class="card-title">Selecciona el periodo con el que trabajaras:</h5>
      
      <br>
      <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" type="submit">Seleccionar periodo</button>
        </div> 
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Añadir periodo
            </button>
        </div>
      </div> 
    </div>
  </div>
@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir periodo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Fecha de Inicio</label>
                    <input type="date" class="form-control" id="inputEmail4">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de Fin</label>
                    <input type="date" class="form-control" id="inputPassword4">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de Pago</label>
                    <input type="date" class="form-control" id="inputPassword4">
                  </div>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>