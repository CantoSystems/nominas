@extends('layouts.principal')

@section('content') 


<div class="card">
    <div class="card-header">
      Empresas
    </div>
    <div class="card-body">
        <form action="{{route('seleccionarempresa')}}" method="GET">
        <div class="col-md-12">
            <h5 class="card-title">Selecciona la nomina con la que se trabajara:</h5>
        </div>
      <br>
      <div class="row">
        <div class="col-md-8">
            <select class="custom-select" name="empresa">
                @foreach($empresas as $empresa)
                  <option value="{{$empresa->clave}}">{{$empresa->nombre}}</option> 
                @endforeach
            </select>
         </div>    
         <button type="submit">Seleccionar</button>
        </form>
      </div>

    </div>
  </div>
@endsection