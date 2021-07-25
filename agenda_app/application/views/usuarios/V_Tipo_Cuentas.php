<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>


<script type="text/javascript">   
    

$(document).ready(function() {   

//Ingresamos el perfil

$("#ingresar").click(function(){

    var parametros = {

      "descripcion_tip" :$("#descripcion_tip").val(),
               
    }

    $.ajax({

        data:  parametros,
        url:   '<?php echo base_url();?>C_Perfiles/insertar_perfil',
        type:  'post',

        success:  function (response) {
        
        //$("#modal_confirmar").modal('show');
        insertar_perfil_permisos();
                     
                }
        });
        
        
  });
//Fin de Ingreso de Perfil

//Insertar permisos

function insertar_perfil_permisos(){

$(".permiso").each(function(){

    if ($(this).is(':checked')) {

      var parametros = {

         "descripcion_tip" : $("#descripcion_tip").val(),
         "id_man":$(this).val(),
    
           }

     $.ajax({
                data:  parametros,
                url:   '<?php echo base_url();?>C_Perfiles/insertar_permisos',
                type:  'post',

                success: function (response){

                  actualizar_datos();
                
                }


             });
       }
 });


}

//fin insertar permisos

//Actualizar Datos de la Tabla

  function actualizar_datos(){


     $("#datos").load(location.href+" #datos>*","");

     $('#datos').show();
  }

//Fin Actualizar

});

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


<section class="content-header">

    <h1>Administrar Perfiles
     <small>Usuarios</small>
    </h1>
        
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i>Horarios</a></li>
       <li class="active">Administrar Horarios</li>
      </ol>

</section>

<section class="content">

 <div class="box box">

   <div class="box-header with-border">
      <h3 class="box-title">Datos del Perfil</h3>
   </div>

  <div class="box-body">
 
    <div class="row">


      
      <div class="col-md-4">
                            
        <div class="form-group">
          <label>Nombre del Perffil</label>
          <input type="text" id="descripcion_tip" name="descripcion_tip" class="form-control" placeholder="Ej. Administrador">
          <span class="hide" id="msg_p" style="color:red;">Debe completar este campo</span>
          <span class="hide" id="msg_p_v" style="color:red;">este perfil ya existe</span>
          <p style="visibility: hidden;">dasdadas</p>
                         
         <button class="btn btn-primary" id="ingresar">ingresar</button>
         <button id="modificar" type="button" class="btn btn-primary">Modificar</button>
         <button id="limpiar" class="btn bg-red">Cancelar</button>
      
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Mantenedores</label>
           <br>
           <?php echo $opciones; ?>
         </br>
     
        </div>
      </div>



  
 </div>



    <br>


              <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <th>Nombre del Perfil</th>
          <th>Mantenedores</th>
                <th>Acciones</th>
                </tr>
              <tbody class="" id="datos">
               <?php echo $tabla; ?>
            
           
      
        </tbody>
              </table>
            </div>


  </div>

   

</section>
