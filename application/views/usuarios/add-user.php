<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>

<div class="container-fluid" style="height:100px; width:900px; margin-top: 0px; margin-left:50px; padding-left: 10px;">   
            <div class="page-header" style="float:left; margin-top: 50px;">
                <div class="page-header-title" style="float:left; display: inline;">
                    <h4 style="float:left; display: inline; margin-right: 20px;">Estudiante</h4>
                <!--<div style="float:left; width:50px; "> </div>  -->
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#Add_Estudiante" <span class="fa fa-plus"></span>Nuevo</a>
                </div>
                </div>
                
            
     <div class="page-body">
        
        <script>
                         
          function submitdata() { 
                var r=confirm("Esta seguro que desea crear nuevo Usuario?"); 
                if(r==true) { 
                	if($("input[name="email_user"]").length != 0) {
                 	   //Form is valid
                		alert("Se ha enviado datos correctamente");
                 	   }
                 	   else {
                 	   //Form is invalid
                 	   alert("No es posible enviar formulario....usuario o email NO debe repetirse");
                 	   }
                    return true;
                } else { 
                    
                    return false;
                }
            
            }


           
            </script>    
       
      
       
       <div class="modal fade" data-backdrop="static"   data-keyboard="false" id="Add_Estudiante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document" style="height: 80% !important;">
                <div class="modal-content"  style="width: 900px;">
                  <div class="modal-header">
                    <h2 align="center" class="modal-title" id="exampleModalLabel">Ingrese datos para nuevo Estudiante</h2>
                    
                  </div>
                  <div class="modal-body">
                  
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        
                     
                            <!--<?php var_dump($centro)?> -->
                            
                           
                             
                             <div class="col-sm-12">
           <?php echo form_open('C_Estudiantes/create_estudiante/', ' role="form" class="form-horizontal" id="registroUser" onsubmit="return submitdata();"'); ?>
                                  
        <div class="form-group col-md-4">
            <label >Cedula:</label>
            
            <input type="text" name="rut_estu" class="form-control" minlength=10 maxlength=10 placeholder="Ingrese Cedula" required>
      </div>
	
	
	<div class="form-group col-md-4">
            <label >Nombre 1:</label>
            
            <input type="text" name="pnombre" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
       <div class="form-group col-md-4">
            <label >Nombre 2:</label>
            
            <input type="text" name="snombre" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
       <div class="form-group col-md-4">
            <label >Apellido Paterno:</label>
            
            <input type="text" name="apellido_pa" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
      <div class="form-group col-md-4">
            <label >Apellido Materno:</label>
            
            <input type="text" name="apellido_ma" class="form-control" minlength=4 maxlength=60 placeholder="Ingrese Apellido de Usuario" required>
      </div>
                                 
      <div class="form-group col-md-4">
            <label >Telefono:</label>
            
            <input type="text" name="fono_estu" class="form-control"  required>
      </div>
      
      <div class="form-group col-md-4">
            <label >Email:</label>
            
            <input type="text" name="correo_estu" id="email" class="form-control" minlength=4 maxlength=80 placeholder="Ingrese Email de Usuario" onchange="get_email_login()" autocomplete="off" required>
              <div id="msg1" > </div>               
             <input type="hidden" name="email_user" id="email_user">
      </div>
      
      

    
     

     

       <div class="form-group row">
                                       
                                        <div class="col-sm-10"  style="float:left; margin-left: 300px;">
                                            <button type="submit" name="submit" id="submit_user" class="btn btn-primary">Enviar</button>
                                            <button type="button" id="btnCerrar" class="btn btn-primary" data-dismiss="modal">Salir</button>
                                        </div>
                                    </div>


      </form>
                               </div>
                                   
                                </div>
                            </div>
                        </div>
                </div>
             </div>

          		</div>
                  
                </div>
              </div>
    
    