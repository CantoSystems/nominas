<div class="modal fade" id="modalmodificaempleado{{$persona->id_emp}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
          <img class="img-responsive" src="http://placehold.it/1200x600/555/000&text=One" alt="...">
            <div class="carousel-caption">
              One Image
            </div>
          </div>
          <div class="item">
            <img class="img-responsive" src="http://placehold.it/1200x600/fffccc/000&text=Two" alt="...">
            <div class="carousel-caption">
              Another Image
            </div>
          </div>
          <div class="item">
            <img class="img-responsive" src="http://placehold.it/1200x600/fcf00c/000&text=Three" alt="...">
            <div class="carousel-caption">
              Another Image
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>
  </div>
</div>
<script>
  let porcentaje =  document.getElementById('porcentaje');
  let porcentaje1 = document.getElementById('porcentaje1');
  let porcentaje2 = document.getElementById('porcentaje2');
  let porcentaje3 = document.getElementById('porcentaje3');
  let porcentaje4 = document.getElementById('porcentaje4');

  let beneficiario = document.getElementById('beneficiario');
  let beneficiario1 = document.getElementById('beneficiario1');
  let beneficiario2 = document.getElementById('beneficiario2');
  let beneficiario3 = document.getElementById('beneficiario3');
  let beneficiario4 = document.getElementById('beneficiario4');

  let parentesco = document.getElementById('parentesco');
  let parentesco1 = document.getElementById('parentesco1');
  let parentesco2 = document.getElementById('parentesco2');
  let parentesco3 = document.getElementById('parentesco3');
  let parentesco4 = document.getElementById('parentesco4');

  let mensaje = document.getElementById('mensaje');

   porcentaje.addEventListener('keypress', ()=>{
    let sumainicio = parseInt(porcentaje.value);

      if (sumainicio > 100) {
        porcentaje1.disabled = true;
        porcentaje2.disabled = true;
        porcentaje3.disabled = true;
        porcentaje4.disabled = true;
        beneficiario1.disabled = true;
        beneficiario2.disabled = true;
        beneficiario3.disabled = true;
        beneficiario4.disabled = true;
        parentesco1.disabled = true;
        parentesco2.disabled = true;
        parentesco3.disabled = true;
        parentesco4.disabled = true;
        porcentaje.value = '';
        porcentaje1.value = '';
        porcentaje2.value = '';
        porcentaje3.value = '';
        porcentaje4.value = '';
        mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
      }else if(sumainicio === 100){
        porcentaje1.disabled = true;
        porcentaje2.disabled = true;
        porcentaje3.disabled = true;
        porcentaje4.disabled = true;
        beneficiario1.disabled = true;
        beneficiario2.disabled = true;
        beneficiario3.disabled = true;
        beneficiario4.disabled = true;
        parentesco1.disabled = true;
        parentesco2.disabled = true;
        parentesco3.disabled = true;
        parentesco4.disabled = true;
        porcentaje1.value = '';
        porcentaje2.value = '';
        porcentaje3.value = '';
        porcentaje4.value = '';
        mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';
      }else if(sumainicio < 100){
        porcentaje1.disabled = false;
        porcentaje2.disabled = false;
        porcentaje3.disabled = false;
        porcentaje4.disabled = false;
        beneficiario1.disabled = false;
        beneficiario2.disabled = false;
        beneficiario3.disabled = false;
        beneficiario4.disabled = false;
        parentesco1.disabled = false;
        parentesco2.disabled = false;
        parentesco3.disabled = false;
        parentesco4.disabled = false;
        mensaje.innerHTML = '';
      }
  })

    porcentaje1.addEventListener('keyup', ()=>{
    let sumavalores = parseInt(porcentaje.value) + parseInt(porcentaje1.value);
      if (sumavalores > 100) {
        porcentaje1.focus();
        porcentaje2.disabled = true;
        porcentaje3.disabled = true;
        porcentaje4.disabled = true;
        beneficiario2.disabled = true;
        beneficiario3.disabled = true;
        beneficiario4.disabled = true;
        parentesco2.disabled = true;
        parentesco3.disabled = true;
        parentesco4.disabled = true;
        //porcentaje.value = '';
        porcentaje1.value = '';
        porcentaje2.value = '';
        porcentaje3.value = '';
        porcentaje4.value = '';
        mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
      }else if(sumavalores === 100){
        porcentaje1.focus();
        porcentaje2.disabled = true;
        porcentaje3.disabled = true;
        porcentaje4.disabled = true;
        beneficiario2.disabled = true;
        beneficiario3.disabled = true;
        beneficiario4.disabled = true;
        parentesco2.disabled = true;
        parentesco3.disabled = true;
        parentesco4.disabled = true;
        porcentaje2.value = '';
        porcentaje3.value = '';
        porcentaje4.value = '';
        mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';
      }else if(sumavalores < 100){
        porcentaje2.disabled = false;
        porcentaje3.disabled = false;
        porcentaje4.disabled = false;
        beneficiario2.disabled = false;
        beneficiario3.disabled = false;
        beneficiario4.disabled = false;
        parentesco2.disabled = false;
        parentesco3.disabled = false;
        parentesco4.disabled = false;
        parentesco2.disabled = false;
        parentesco3.disabled = false;
        parentesco4.disabled = false;
        mensaje.innerHTML = '';
      }
  })
  porcentaje2.addEventListener('keyup', ()=>{
    let sumatotal = parseInt(porcentaje.value) + parseInt(porcentaje1.value) + parseInt(porcentaje2.value);
    console.log(sumatotal);
    if (sumatotal > 100) {
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      beneficiario3.disabled = true;
      beneficiario4.disabled = true;
      parentesco3.disabled = true;
      parentesco4.disabled = true;
      //porcentaje.value = '';
      //porcentaje1.value = '';
      porcentaje2.value = '';
      porcentaje3.value = '';
      porcentaje4.value = '';
      porcentaje2.focus();
      mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
    }else if (sumatotal === 100){
      porcentaje3.disabled = true;
      porcentaje4.disabled = true;
      beneficiario3.disabled = true;
      beneficiario4.disabled = true;
      parentesco3.disabled = true;
      parentesco4.disabled = true;
      porcentaje3.value = '';
      porcentaje4.value = '';
      mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';
    }else if(sumavalores < 100){
      porcentaje3.disabled = false;
      porcentaje4.disabled = false;
      beneficiario3.disabled = false;
      beneficiario4.disabled = false;
      parentesco3.disabled = false;
      parentesco4.disabled = false;
       mensaje.innerHTML = '';
    }
  })
  porcentaje3.addEventListener('keyup', ()=>{
    let suma = parseInt(porcentaje.value) + parseInt(porcentaje1.value) + parseInt(porcentaje2.value)+parseInt(porcentaje3.value);
    console.log(suma);
    if (suma > 100) {
      porcentaje4.disabled = true;
      beneficiario4.disabled = true;
      parentesco4.disabled = true;
      //porcentaje.value = '';
      //porcentaje1.value = '';
      //porcentaje2.value = '';
      //porcentaje3.value = '';
      porcentaje4.value = '';
      porcentaje3.focus();
      mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
    }else if(suma === 100){
      porcentaje4.disabled = true;
      beneficiario4.disabled = true;
      parentesco4.disabled = true;
      porcentaje4.value = '';
      mensaje.innerHTML = 'A acumulado el total de porcentajes no puede agregar uno nuevo';
    }else if(suma < 100){
      porcentaje4.disabled = false;
      beneficiario4.disabled = false;
      parentesco4.disabled = false;
      mensaje.innerHTML = '';
    }
  })
 porcentaje4.addEventListener('keyup', ()=>{
    let sumasfinal = parseInt(porcentaje.value) + parseInt(porcentaje1.value) + parseInt(porcentaje2.value)+parseInt(porcentaje3.value)+parseInt(porcentaje4.value);
    console.log(sumasfinal)
    if (sumasfinal > 100) {
      //porcentaje.value = '';
      //porcentaje1.value = '';
      //porcentaje2.value = '';
      //porcentaje3.value = '';
      porcentaje4.value = '';
      porcentaje4.focus();
      mensaje.innerHTML = 'Corregir, no puede exceder a 100%';
    }else if(sumasfinal === 100){
      mensaje.innerHTML = 'Excelente, valores sumados son del 100%';
    }else if(sumasfinal< 100){
      //porcentaje.value = '';
      //porcentaje1.value = '';
      //porcentaje2.value = '';
      //porcentaje3.value = '';
      porcentaje4.value = '';
      porcentaje4.focus();
      mensaje.innerHTML = 'Corregir, no puede ser menores a 100%';
    }
  })
</script>