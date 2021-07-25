<div class="container-fluid" style="height:400px; width:1100px; margin-top: 10px; margin-left:20px; padding-left: 10px;">

    <div class="page-header">
        <div class="page-header-title" >
                    <h3 style="float:left; margin-left: 280px;">Lista de Estudiantes</h3>
                    
                </div>
                
            </div>
           
            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body" style="float:left; margin-left: -400px; margin-top: 50px;">
                
   <script>
$(document).ready(function(){
	
        $('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('#id_pais').val(id)
		})
        
        
        $( "#eliminarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
                
			 $.ajax({
					type: "POST",
					url: '<?php echo base_url();?>C_Estudiantes/eliminar',
					data: parametros,
					success: function(datos){
					$(".datos_ajax_delete").html("Eliminado Registro...");
					
					$('#dataDelete').modal('hide');
					$("#tblEstudiantes").load(" #tblEstudiantes");
				  }
			});
		  event.preventDefault();
		});
        
  
   
                $('#Actualiza_Estudiante').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var codigo = button.data('codigo') // Extraer la información de atributos de datos
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var moneda = button.data('moneda') // Extraer la información de atributos de datos
		  var capital = button.data('capital') // Extraer la información de atributos de datos
		  var continente = button.data('continente') // Extraer la información de atributos de datos
		  
		  var modal = $(this)
		  //modal.find('.modal-title').text('Modificar país: '+nombre)
		  modal.find('.modal-body #rut_estu').val(id)
		  modal.find('.modal-body #pnombre1').val(codigo)
		  modal.find('.modal-body #snombre1').val(nombre)
		  modal.find('.modal-body #apellido_pa1').val(moneda)
		  modal.find('.modal-body #apellido_ma1').val(capital)
		  modal.find('.modal-body #fono_estu1').val(continente)
		  $('.alert').hide();//Oculto alert
		})
		
		

	$( "#actualidarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: '<?php echo base_url();?>C_Estudiantes/actualiza_estudiante',
					data: parametros,
					 
					success: function(datos){
					$(".datos_ajax_delete").html("Se ha actualizado correctamente");
					
					$('#Actualiza_Estudiante').modal('hide');
					//$('#tblEstudiantes').DataTable().ajax.reload();
					
					$("#tblEstudiantes").load(" #tblEstudiantes");
				  }
			});
		  event.preventDefault();
		});
        
        
});
</script> 
                <!-- DOM/Jquery table start -->
                
    <form id="eliminarDatos">
<div class="modal fade" id="dataDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <input type="text" id="id_pais" name="id_pais">
      <h2 class="text-center text-muted">Estas seguro?</h2>
	  <p class="lead text-muted text-center" style="display: block;margin:10px">Esta acción eliminará de forma permanente el registro. Deseas continuar?</p>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-lg btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</form>
    
        <?php echo form_open( 'data-toggle="validator" role="form" class="form-horizontal" id="actualidarDatos" '); ?>        
                <div class="modal fade" data-backdrop="static"   data-keyboard="false" id="Actualiza_Estudiante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document" style="height: 200% !important;">
                <div class="modal-content"  style="width: 900px;">
                  <div class="modal-header">
                    <h2 align="center" class="modal-title" id="exampleModalLabel">Actualizar datos de Estudiante</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      

         
               
        <div class="form-group col-md-4">
            <label >Cedula:</label>
            
            <input type="text" name="rut_estu" id="rut_estu" class="form-control" minlength=10 maxlength=10  readonly="true">
      </div>
	
	
	<div class="form-group col-md-4">
            <label >Nombre 1:</label>
            
            <input type="text" name="pnombre" id="pnombre1" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
       <div class="form-group col-md-4">
            <label >Nombre 2:</label>
            
            <input type="text" name="snombre" id="snombre1" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
       <div class="form-group col-md-4">
            <label >Apellido Paterno:</label>
            
            <input type="text" name="apellido_pa" id="apellido_pa1" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
      <div class="form-group col-md-4">
            <label >Apellido Materno:</label>
            
            <input type="text" name="apellido_ma" id="apellido_ma1" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
      <div class="form-group col-md-4">
            <label >Telefono:</label>
            
            <input type="text" name="fono_estu" id="fono_estu1" class="form-control"  required>
      </div>
      
      <div class="form-group col-md-4">
            <label >Email:</label>
            
            <input type="text" name="correo_estu" id="correo_estu1" class="form-control" minlength=4 maxlength=80 placeholder="Ingrese Email de Usuario" onchange="get_email_login()" autocomplete="off" required>
              <div id="msg1" > </div>               
             <input type="hidden" name="email_user" id="email_user">
      </div>
      
     
       <div class="form-group row">
                                       
                                        <div class="col-sm-10"  style="float:left; margin-left: 300px;">
                                            <button type="submit" name="submit" id="submit_user" class="btn btn-primary">Grabar</button>
                                            <button type="button" id="btnCerrar" class="btn btn-primary" data-dismiss="modal">Salir</button>
                                        </div>
                                    </div>

         </div>
                 
                </div>
              </div>
       </div>
   </form> 
		
				
                <div class="card" style="float:left; margin-left: -50px;">
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table  class="table table-striped table-bordered nowrap" id="tblEstudiantes" width="100%" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombre 1</th>
                                         <th>Nombre 2</th>
                                        <th>Apellido P</th>
                                        <th>Apellido M</th>
                                        <th>Email</th>
                                        <th>Contacto</th>
                                        
                                        
                                         <th>Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($users as $post) : ?>
                                 <tr>
                                        <td><?php echo $post['rut_estu']; ?></td>
                                      
                                        <td><?php echo $post['pnombre']; ?> </td>
                                        <td><?php echo $post['snombre']; ?> </td>
                                        <td><?php echo $post['apellido_pa']; ?> </td>
                                        <td><?php echo $post['apellido_ma']; ?> </td>
                                        <td><?php echo $post['correo_estu']; ?></td>
                                        <td><?php echo $post['fono_estu']; ?></td>
                                         
                                         
                                        <td>
                                                
                                            <!--   <a class="btn btn-primary" href='<?php echo base_url(); ?>C_Estudiantes/eliminar_estudiante/<?php echo $post['rut_estu']; ?>'>Eliminar</a>   -->
                                             <!--  <a class="btn btn-primary"  data-id="<?php echo $post['rut_estu'];  ?>" data-toggle="modal" data-target="#Actualiza_Estudiante">Editar</a>   -->
                                         <!--      <button type="button" class="btn btn-success edit" id="edit" data-toggle="modal" data-target="#Actualiza_Estudiante" value="<?php echo $post['rut_estu'];  ?> ?>"><span class="glyphicon glyphicon-edit"></span>  Edit</button>  -->
                                               
                                             <!--   <a class="btn btn-primary" href='<?php echo base_url(); ?>admin/estudiante/enable/<?php echo $post['cedula']; ?>'>Activar</a>  -->
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Actualiza_Estudiante" data-id="<?php echo $post['rut_estu']; ?>" data-codigo="<?php echo $post['pnombre']; ?>" data-nombre="<?php echo $post['snombre']; ?>" data-moneda="<?php echo $post['apellido_pa']; ?>" data-capital="<?php echo $post['apellido_ma']; ?>" data-continente="<?php echo $post['fono_estu']; ?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $post['rut_estu']; ?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>                                  
                                                
                                                
                                            
                                        </td>
                                        
                                        
                                    </tr>
                                <?php endforeach; ?>

                               
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          
                <!-- DOM/Jquery table end -->
              <div class="row">
		
		
		
		<div class="col-xs-12">
		<!--<div id="loader" class="text-center"> <img src="loader.gif"></div>  -->
                    <div class="datos_ajax_delete" style="color:green; font-size: 22px;"></div><!-- Datos ajax Final -->
		<div class="outer_div"></div><!-- Datos ajax Final -->
		</div>
	  </div>  
                
            </div>
       </div>
