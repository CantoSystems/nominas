@extends('layouts.principal')

@section('content')
<div class="card">
    <div class="card-header">
      Periodos
    </div>
    <div class="card-body">
      <h5 class="card-title">Selecciona el periodo con el que trabajaras:</h5><br>
      
      <br>
      <div class="row">
        @if ($cant==0)
        <div class="col-md-12">
          <h3>No se tienen periodos</h3><br>
        </div>
          <br>
          <div class="col-md-6">
          </div>
          <div class="col-md-6">
            <button type="button" data-toggle="modal" data-target="#AgregarPeriodo" style="width:220px; height:40px">
              Agregar Periodo
            </button>
            @include('periodos.modalregistro')
          </div>
          
        @else
        <div class="row">
          <form action="{{route('seleccionarperiodo')}}" method="GET">

            <div class="col-md-12">
              <select class="custom-select" name="periodo">
                @foreach ($periodos as $periodo)
                <option value={{$periodo->numero}}> DE: {{$periodo->fecha_inicio}} A {{$periodo->fecha_fin}}</option>
                @endforeach
              </select>
            </div><br> 
            
            <div class="col-md-6">
              <button type="submit" style="width:220px; height:40px">Seleccionar</button>
            </div>
          </form>

          <!--<div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AgregarPeriodo">
              Agregar Periodo
            </button>
          </div>
          @include('periodos.modalregistro')-->
        </div>
        
        @endif
      </div> 
    </div>
  </div>
@endsection

