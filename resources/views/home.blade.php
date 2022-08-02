@extends('layouts.principal')
  @section('content') 
  <div class="card">
    <div class="card-body">
      <form action="{{route('seleccionarempresa')}}" method="GET">
        <div class="col-md-12">
          <h5 class="card-title modalPersonalizado">Selecciona la nómina con la que se trabajará:</h5>
        </div>
        <br>
        <div class="row">
          <div class="col-md-8"><br>
            <select class="custom-select personalizado" name="empresa">
              @foreach($empresas as $empresa)
                <option value="{{$empresa->clave}}">{{$empresa->nombre}} | {{$empresa->nombre_nomina}} </option> 
              @endforeach
            </select>
          </div>    
        </div>
        <div class="formato">
            <br>
            <button type="submit">Seleccionar</button>
        </div>
      </form>
    </div>
  </div>
  @endsection