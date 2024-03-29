@extends('layouts.principal')
@section('content')
<div class="card">
  <div class="card-header">
    Periodos 
    <strong>
      {{ Session::get('empresa') }}
    </strong>
  </div>
  <div class="card-body">
    <h5 class="card-title modalPersonalizado">Selecciona el periodo con el que trabajarás:</h5>
    <br>
    <div class="row">
      <form action="{{route('seleccionarperiodo')}}" method="GET">
        <div class="col-md-12">
          <select class="custom-select nuevo" name="periodo">
            @foreach($periodos as $periodo)
              <option value="{{$periodo->numero}}"> DE: {{$periodo->fecha_inicio}} A {{$periodo->fecha_fin}}</option> 
            @endforeach
          </select>
        </div>
        <br> 
        <div class="col-md-6">
          <button type="submit" style="width:120px; height:40px">Seleccionar</button>
        </div>
      </form>
    </div> 
  </div>
</div>
@endsection