<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>


<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Reporte de Porcentaje</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Parámetros de Busqueda
      </div>
      <div class="panel-body">
<form id="form" >
 <div class="box-body">

   <div class="row">
     <div class="col-md-3">
       <div class="form-group">
         <label>Fecha de Inicio</label>
          <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="<?php echo  date('Y-m-d'); ?>">
       </div>
     </div>

     <div class="col-md-3">
       <div class="form-group">
         <label>Fecha de Termino</label>
          <input type="date" class="form-control" id="fecha_ter" name="fecha_ter" value="<?php echo  date('Y-m-d'); ?>">
       </div>
     </div>



     <div class="col-md-3">
        <div class="form-group">
          <label>Sede</label>
          <?= form_open(base_url().'C_Porcentaje_Ad/hacerAlgo'); ?>
           <select class="form-control" id="id_suc" name="id_suc">
             <option value="0" class="required">Todas</option>
             <?php
                    foreach ($sucursales as $i) {
                        echo '<option value="'. $i->id_suc .'">'. $i->nombre_suc .'</option>';
                    }
                ?>

           </select>
        </div>
      </div>

   </div>

  <div class="row">

      <div class="col-md-3">
        <div class="form-group">
          <label>Jefes de Carrera</label>
           <select class="form-control" id="rut_usu" name="rut_usu">
             <option value="0">Todos</option>


           </select>
           <span class="hide" id="msg_pn" style="color:red;">Este campo no puede quedar en blanco</span>
        </div>
      </div>

      </form>

        <div class="col-md-3" style="top:25px; left: 30px;" >
                   <div class="form-group">
                        <button type="button" name="cancelar" id="cancelar" class="btn btn-default" style="width:80px;">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_buscar" name="btn_buscar" >Buscar</button>

                   </div>
               </div>
               </div>


     </div>


   </div></div></div></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<script>
$(document).ready(function(){

   $('#btn_buscar').on('click', function(){

    var fecha_ini =  $("#fecha_ini").val();
    var fecha_ter =  $("#fecha_ter").val();
    var id_suc =  $("#id_suc").val();
    var sede =  $( "#id_suc option:selected" ).text();
    var rut_usu =  $("#rut_usu").val() ;
    var jc = $( "#rut_usu option:selected" ).text();
    var imagen = '<?php echo base_url();?>assets/img/logo-aiep.png';
    var hoy = '<?php echo date("Y-m-d"); ?>';




    window.open('<?php echo base_url();?>C_Porcentaje_Ad/tabla_porcentaje?fecha_ini=' + fecha_ini + '&fecha_ter=' + fecha_ter + '&rut_usu=' + rut_usu + '&jc=' + jc + '&imagen=' + imagen +'&hoy=' + hoy + '&sede=' + sede  +'&id_suc=' + id_suc );

   });


       $("#id_suc").change(function() {

      $("#id_suc option:selected").each(function() {

          id_suc = $('#id_suc').val();

          $.post("<?php echo base_url();?>C_Porcentaje_Ad/cargar_usuarios", {

          id_suc : id_suc

          },

        function(data) {

          $("#rut_usu").html(data);

          });
      });
  });


});

</script>
