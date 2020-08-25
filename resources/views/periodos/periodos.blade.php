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
        @if ($cant==0)
        <div class="col-md-12">
          <h3>No se tienen periodos</h3>
        </div>
          <br>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AgregarPeriodo">
            Agregar Periodo
          </button>
          @include('periodos.modalregistro')
        @else
        <div class="row">
          <form action="{{route('seleccionarperiodo')}}" method="GET">
            <select class="custom-select" name="periodo">
              @foreach ($periodos as $periodo)
            <option value={{$periodo->numero}}> DE: {{$periodo->fecha_inicio}} A {{$periodo->fecha_fin}}</option>
              @endforeach
            </select> 
            <br><br>
            <div class="col-md-6">
              <button class="btn btn-primary" type="submit">Seleccionar</button>
            </div>
          </form>
          <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AgregarPeriodo">
              Agregar Periodo
            </button>
          </div>
          @include('periodos.modalregistro')
        </div>
        
        @endif
      </div> 
    </div>
  </div>
@endsection

