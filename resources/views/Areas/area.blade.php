@extends('layouts.segunda')
@section('content')
<div class="card card-secondary">
	<div class="card-header">
        <h3 class="card-title">Areas</h3>
    </div>
    <script type="text/javascript">
        function validar(e) { 
        tecla = (document.all) ? e.keyCode : e.which; 
        if (tecla==8) return true; 
        patron =/[A-Za-z\s]/; 
        te = String.fromCharCode(tecla); 
        return patron.test(te); 
        }
</script>
    <div class="card-body">
    <form action="{{ route('areas.index')}}" method="GET">
    		<div class="row">
    			<div class="col-md-12">
                    <div class="form-group">
                        <label>Nombre:</label>
<<<<<<< HEAD
                    <input type="text" name="nombre" class="form-control" value="{{$aux->area}}"  onkeyup="mayus(this);" onkeypress="return numeros(event)">
                    <input type="hidden" name="identificador" class="form-control" value="{{$aux->id}}"  onkeyup="mayus(this);">
=======
                            <input type="text" name="areas" class="form-control" value="{{$aux->area}}"  onkeyup="mayus(this);">
                            

>>>>>>> a8098cc622187acac6f0753420f88e70439e8cde

                    <input type="text" name="clave_area" class="form-control" value="{{$aux->clave_area}}"  onkeyup="mayus(this);">
                    <input type="hidden" name="identificador" class="form-control" value="{{$aux->id}}"  onkeyup="mayus(this);">
                    </div>
                </div>
                
                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="submit"  name="acciones" value="primero" id="primero" style='width:70px; height:40px'><i class="fas fa-backward" ></i></button>
                                </div>
                                <div class="form-group">
                                <button type="submit" name="acciones" value="atras" id="atras" style='width:70px; height:40px'><i class="fas fa-arrow-circle-left"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="siguiente" id="siguiente" style='width:70px; height:40px'><i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="acciones" value="ultimo" id="ultimo" style='width:70px; height:40px'><i class="fas fa-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-5">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    <button type="button" id="nuevo" style='width:70px; height:40px'> <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="form-group">
                                 <button type="button" id="actualizar" style='width:70px; height:40px'> <i class="fas fa-pen-square"></i></button>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="eliminar" data-target="#modal-deletenom- data-toggle="modal" style='width:70px; height:40px'>
                                        <button type="button" style='width:70px; height:40px'>
                                            <i class="far fa-trash-alt">
                                            </i>
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-sm-2">
                    <div class="card-body">
                        <div class="margin">
                            <div class="btn-group">
                                <div class="form-group">
                                    
                                       <button class="btn btn-primary" id="nuevo_reg" name="acciones" value="registrar" type="submit" style="display: none;width:70px; height:40px'"><i class="fas fa-save"></i></button>
                                        
                                    
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning" name="acciones" value="actualizar" id="actualizar_reg" type="submit" style="display: none;width:70px; height:40px'"><i class="fas fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
    	</form>	
        
   	</div> 	
</div>	

<script>
    $(function(){
      $('#nuevo').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('input[type="text"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar').click(function(){
        $('#nuevo_reg').hide();
      $('#actualizar_reg').show();
      $('#primero').hide();
      $('#atras').hide();
      $('#siguiente').hide();
      $('#ultimo').hide();
      });
    })
</script>
@endsection




                    