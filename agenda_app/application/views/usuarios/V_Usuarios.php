<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>
 <script src="<?php echo base_url();?>assets/rut/jquery.rut.js"></script> 
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link href="<?php echo base_url();?>assets/img/logo-32.ico" type="image/x-icon" rel="shortcut icon" />

<script type="text/javascript">


$(document).ready(function() {

$("#btn_insert").prop("disabled", false);  
 window.document.r_usuarios.rut_usu.focus();
 window.document.r_usuarios.rut_usu.select();

   $("#r_usuarios input").keyup(function() {
    var form = $(this).parents("#r_usuarios");
    var check = checkCampos(form);
    console.log(check);
    if(check) {
      $("#btn_insert").prop("disabled", false);
    }
    else {
      $("#btn_insert").prop("disabled", true);
    }
  });

function checkCampos(obj) {
  var camposRellenados = true;
  obj.find("input").each(function() {
    var $this = $(this);
      if( $this.val().length <= 0 ) {
        camposRellenados = false;
        return false;
      }
  });
  if(camposRellenados == false) {
    return false;
  }
  else {
    return true;
  }
}


//Ingresamos los datos del Usuario



$("#btn_insert").click(function(){

    var parametros = {

      "rut_usu" :$("#rut_usu").val(),
      "nombre_usu" :$("#nombre_usu").val(),
      "pnombre" :$("#pnombre").val(),
      "snombre" :$("#snombre").val(),
      "apellido_pa" :$("#apellido_pa").val(),
      "apellido_ma" :$("#apellido_ma").val(),
      "fono_usu" :$("#fono_usu").val(),
      "correo_usu" :$("#correo_usu").val(),
      "pass_usu" :$("#pass_usu").val(),
      "id_tip" :$("#id_tip").val(),
      "id_suc" :$("#id_suc").val(),
      "estado" :$("#estado").val(),

    }

    $.ajax({

        data:  parametros,
        url:   '<?php echo base_url();?>C_Usuarios/insertar_usuario',
        type:  'post',

        success:  function (response) {

        $("#modal_confirmar").modal('show');


                }
        });


  });

//---VALIDAR RUT--------------------------------------

       $("#rut_usu").keypress(function(){
            $("#btn_insert").prop("disabled", true);
           $("#rut_usu").removeClass("blanco");
           $("#msg_rut").addClass("hide");

           $("#resultado").addClass("hide");
        });

$("#rut_usu").rut().on('rutInvalido', function(e) {


    $("#btn_insert").prop("disabled", true);  /*ojo   */
   $("#nombre_usu").addClass("blanco");
    $("#msg_rut").removeClass("hide");

           window.document.r_usuarios.rut_usu.focus();
           window.document.r_usuarios.rut_usu.select();
           return false;
});

$("#rut_usu").focusout(function(){

    $("#resultado").removeClass("hide");
    
    //obtenemos el texto introducido en el campo
    var parametros = {"rut_usu" : $("#rut_usu").val()};
    //var cod_usur= $("#rut_usu").val();
    //alert(cod_usur);
    //hace la busqueda
    $.ajax({
        type: "post",
        url: '<?php echo base_url();?>C_Usuarios/consultar_rut',
        data: parametros,
        dataType: "html",
        error: function(){
            alert("error peticion ajax");
        },success: function(data){
          if(data){

              $('#btn_insert').attr('disabled', 'disabled');
                $('#resultado').html('<span style="color:red;">Ya existe un usuario con esa Cedula</span>');


                   window.document.r_usuarios.rut_usu.focus();
                   window.document.r_usuarios.rut_usu.select();

                   return false;
            }

            else{

              $("#resultado").addClass("hide");

               }

               return true;

        }

    });

});

$("#rut_usu").rut({

  formatOn: 'keyup',
  validateOn: 'change'

});

//---FIN DE VALIDAR RUT--------------------------------



$("#correo_usu").focusout(function(){

    $("#res_correo").removeClass("hide");

    //obtenemos el texto introducido en el campo
    var parametros = {"correo_usu" : $("#correo_usu").val()};

    //hace la b��squeda
    $.ajax({
        type: "post",
        url: '<?php echo base_url();?>C_Usuarios/consultar_correo',
        data: parametros,
        dataType: "html",
        error: function(){
            alert("error petici��n ajax");
        },success: function(data){
          if(data){

              $('#btn_insert').attr('disabled', 'disabled');
                $('#res_correo').html('<span style="color:red;">Ya existe un usuario con ese Correo</span>');


                   window.document.r_usuarios.correo_usu.focus();
                   window.document.r_usuarios.correo_usu.select();

                   return false;
            }

            else{

              $("#res_correo").addClass("hide");

               }

               return true;

        }

    });

});
//--




$('.input-letras').on('input', function () {
    this.value = this.value.replace(/[^A-Za-z ]/g,'');
});

$('.input-number').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g,'');
});



});//FIN DEL DOCUMENTO

</script>



<div id="modal_confirmar" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
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
    <h3 class="page-header">Registro de Usuarios</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Formulario de Registro
      </div>
      <div class="panel-body">
        <form id="r_usuarios" name="r_usuarios">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label>Cedula</label>
              <input type="text" id="rut_usu" name="rut_usu" class="input-number" placeholder="1788119425" autofocus>
              <span class="hide" id="msg_rut" style="color:red;">Cedula Invalida</span>
              <div id="resultado"></div>
            </div>
          </div>
         <div class="col-md-3">
            <div class="form-group">
              <label>Nombre de Usuario</label>
              <input type="text" id="nombre_usu" name="nombre_usu" class="form-control" placeholder="JUAN.SOTOMU">
              <span class="hide" id="msg_nom" style="color:red;">Campo en Blanco</span>
            </div>
          </div>
        <div class="col-md-3">
            <div class="form-group">
              <label></label>
              <input type="text" id="estado" name="estado" class="form-control hide" value="Activada">
              <span class="hide" id="msg_nom" style="color:red;">Campo en Blanco</span>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-3">
              <div class="form-group">
                <label>Primer Nombre</label>
                <input type="text" id="pnombre" name="pnombre" class="form-control input-letras" placeholder="Juan">
                <span class="hide" id="msg_pnom" style="color:red;">Campo en Blanco</span>
              </div>
            </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Segundo Nombre</label>
                <input type="text" id="snombre" name="snombre" class="form-control input-letras" placeholder="Manuel">
                <span class="hide" id="msg_snom" style="color:red;">Campo en Blanco</span>
              </div>
           </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>Apellido Paterno</label>
                <input type="text" id="apellido_pa" name="apellido_pa" class="form-control input-letras" placeholder="Soto">
                <span class="hide" id="msg_apellido_pa" style="color:red;">Campo en Blanco</span>
              </div>
           </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Apellido Materno</label>
                <input type="text" id="apellido_ma" name="apellido_ma" class="form-control input-letras" placeholder="Muñoz">
                <span class="hide" id="msg_apellido_ma" style="color:red;">Campo en Blanco</span>
              </div>
           </div>
      </div>
      <div class="row">
      <div class="col-md-2">
        <div class="form-group">
             <label>Fono</label>
             <input type="number" id="fono_usu" name="fono_usu" class="form-control  input-number" placeholder="988564944">
             <span class="hide" id="msg_fono" style="color:red;">Campo en Blanco</span>
          </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <label>E-Mail</label>
            <input type="email" id="correo_usu" name="correo_usu" class="form-control" placeholder="ejemplo@gmail.com">
             <span class="hide" id="msg_correo" style="color:red;">Campo en Blanco</span>
             <div id="res_correo"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
          <label>Sucursal</label>
           <select class="form-control" id="id_suc" name="id_suc">
           <option value="0">--Seleccione una Sucursal--</option>
          <?php
            $this->load->model('M_Usuarios');
            $sucursales = $this->M_Usuarios->sucursales();
            foreach($sucursales as $fila){
            echo '<option value="'. $fila->id_suc.'">'. $fila->nombre_suc .'</option>';
            } ?>
           </select>
           <span class="hide" id="msg_sucursal" style="color:red;">Campo en Blanco</span>
        </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Tipo de Cuenta</label>
           <select class="form-control" id="id_tip" name="id_tip">
           <option value="0">--Seleccione un Perfil--</option>
          <?php
            $this->load->model('M_Usuarios');
            $tipos_cuenta = $this->M_Usuarios->tipos_cuenta();
            foreach($tipos_cuenta as $fila){
            echo '<option value="'. $fila->id_tip.'">'. $fila->descripcion_tip .'</option>';
          } ?>
           </select>
           <span class="hide" id="msg_cuenta" style="color:red;">Campo en Blanco</span>
        </div>
        </div>
          <div class="col-md-2">
          <div class="form-group">
             <label>Password</label>
             <input type="password" id="pass_usu" name="pass_usu" class="form-control" >
             <span class="hide" id="msg_pass" style="color:red;">Campo en Blanco</span>
          </div>
        </div>
      </form>


      </div>
      <div class="pull-right">
      <button type="button" class="btn btn-default">Cancelar</button>
      <button type="button" class="btn btn-primary" name="btn_insert" id="btn_insert">Registrar Usuario</button>
      </div>
      </div>

    </div>
  </div>
</div>
