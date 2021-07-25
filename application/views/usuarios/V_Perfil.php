<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

$("#btn_update").click(function(){
  var parametros = {
   "rut_usu" :$("#rut_usu").val(),
   "correo_usu" :$("#correo_usu").val(),
   "pass_usu" :$("#pass_usu").val(),
  }
  $.ajax({
    data: parametros,
    url:'<?php echo base_url();?>C_Perfil/editar_perfil',
    type:'post',
    success:  function (response) {
    $("#modal_confirmar").modal('show');
   }
  });
});

});//FIN DEL DOCUMENTO
</script>

<div id="modal_confirmar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje de Confirmación</h4>
      </div>
      <div class="modal-body">
        <p>Datos Guardados Correctamente</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Datos del Perfil</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Formulario de Edición
      </div>
      <div class="panel-body">
        <form id="r_usuarios" name="r_usuarios">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label>Rut</label>
            <input type="text" id="rut_usu" name="rut_usu" class="form-control" value="<?php echo $this->session->userdata('s_rut');?>" disabled>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $this->session->userdata('s_usuario');?>" disabled>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Correo</label>
            <input type="email" id="correo_usu" name="correo_usu" class="form-control" value="<?php echo $this->session->userdata('correo');?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="pass_usu" name="pass_usu" class="form-control" value="<?php echo $this->session->userdata('password');?>">
          </div>
        </div>
      </div>
      <div class=" pull-right" >
        <div class="form-group">
          <button type="button" name="cancelar" id="cancelar" class="btn btn-default" style="width:80px;">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn_update" name="btn_update" >Editar</button>
        </div>
      </div>
    </form>
    </div>
    </div>
  </div>
</div>
