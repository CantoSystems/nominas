$(function(){
      $('#nuevo_periodos').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('#cancelar_periodos').show();
        $('input[type="date"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar_periodos').click(function(){
        $('#nuevo_reg').hide();
        $('#actualizar_reg').show();
        $('#cancelar_periodos').show();
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#nuevo_deptos').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('#cancelar_periodos').show();
        $('input[type="text"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar_deptos').click(function(){
        $('#nuevo_reg').hide();
        $('#actualizar_reg').show();
        $('#cancelar_periodos').show();
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#nuevo_prestaciones').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('#cancelar_periodos').show();
        $('input[type="text"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar_prestaciones').click(function(){
        $('#nuevo_reg').hide();
        $('#actualizar_reg').show();
        $('#cancelar_periodos').show();
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#nuevo_banco').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('#cancelar_reg').show();
        $('input[type="text"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar_banco').click(function(){
        $('#nuevo_reg').hide();
        $('#actualizar_reg').show();
        $('#cancelar_actual').show();
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#nuevo_clasifica').click(function(){
        $('#actualizar_reg').hide();
        $('#nuevo_reg').show();
        $('#cancelar').show();
        $('input[type="text"]').val('');
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
      $('#actualizar_clasifica').click(function(){
        $('#nuevo_reg').hide();
        $('#actualizar_reg').show();
        $('#cancelar').show();
        $('#primero').hide();
        $('#atras').hide();
        $('#siguiente').hide();
        $('#ultimo').hide();
      });
    })