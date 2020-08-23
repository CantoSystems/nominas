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
        @if ($totalperiodos>0)
        <select class="custom-select">
          @foreach ($periodos as $periodo)
          <option value="{{$periodo->id}}">DE: {{$periodo->fecha_inicio}}  A: {{$periodo->fecha_fin}}</option> 
          @endforeach
        </select>
            
        @else
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periodos-Alta">
          Añadir Periodo
        </button>
            @include('periodos.modalregistro')
        @endif
     
      </div> 
    </div>
  </div>
@endsection

