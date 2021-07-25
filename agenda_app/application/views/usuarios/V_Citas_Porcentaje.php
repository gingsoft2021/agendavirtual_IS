

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

     <div class="col-md-2">
       <div class="form-group">
         <label>Sede</label>
            <input type="text" class="form-control" id="sede" name="sede" value="<?php echo $this->session->userdata('sucursal');?>" disabled>
       </div>
     </div>

   </div>

  <div class="row">

       <div class="col-md-4">
       <div class="form-group">
         <label>Jefes de Carrera</label>
         <?= form_open(base_url().'M_Porcentaje/get_usuarios'); ?>
          <select class="form-control" id="rut_usu" name="rut_usu">
            <option value="0">Todos</option>
            <?php
                    $this->load->model('M_Porcentaje');
                    $usuarios = $this->M_Porcentaje->get_usuarios();

                    foreach($usuarios as $fila){

                    echo '<option value="'. $fila->rut.'">'. $fila->nom .' '. $fila->pat .' '.$fila->mat.'</option>';

              }
               ?>

          </select>
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

</div></div>
   </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<script>
$(document).ready(function(){

   $('#btn_buscar').on('click', function(){

    var fecha_ini =  $("#fecha_ini").val();
    var fecha_ter =  $("#fecha_ter").val();
    var sede =  $("#sede").val();
    var rut_usu =  $("#rut_usu").val() ;
    var jc = $( "#rut_usu option:selected" ).text();
    var imagen = '<?php echo base_url();?>assets/img/logo-aiep.png';
    var hoy = '<?php echo date("Y-m-d"); ?>';




    window.open('<?php echo base_url();?>C_Porcentaje/tabla_porcentaje?fecha_ini=' + fecha_ini + '&fecha_ter=' + fecha_ter + '&rut_usu=' + rut_usu + '&jc=' + jc + '&imagen=' + imagen +'&hoy=' + hoy + '&sede=' + sede);

   });

});

</script>
