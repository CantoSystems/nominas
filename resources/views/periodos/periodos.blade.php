@extends('layouts.principal')

@section('content')
<div class="card">
    <div class="card-header">
      Periodos
    </div>
    <div class="card-body">
      <h5 class="card-title">Selecciona el periodo con el que trabajaras: 
      </h5>
      
      <br>
      <div class="row">
        <div class="col-md-6">

        </div> 
        @if (count($periodo) >= 1)
            <div class="col-md-3">
                <button type="submit" style='width:220px; height:40px'>Seleccionar periodo</button>
            </div> 
          
        @elseif(count($periodo) ===0)

        <div class="col-md-3">

            <button type="button" style='width:220px; height:40px'>
              Añadir periodo
            </button> 
          @include('periodos.modalregistro')
            
        </div>
      
        @endif 
      </div> 
    </div>
  </div>
@endsection

