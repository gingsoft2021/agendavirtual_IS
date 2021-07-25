<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>


<script type="text/javascript">



$(document).ready(function() {

var today = moment().format('YYYY-MM-DD');

function new_clock(){

clock = new Date()
hour =   clock.getHours()
minutes = clock.getMinutes()
seconds = clock.getSeconds()

print_clock = today + " " + hour + ":" + minutes + ":" + seconds

document.subida.fecha_registro.value = print_clock
setTimeout(new_clock, 1000)
}

setTimeout(new_clock, 1000)


var today1 = moment().format('YYYY-MM-DD');
document.getElementById("fecha_ini").value = today1;


var today2 = moment().format('YYYY-MM-DD');
document.getElementById("fecha_ter").value = today2;


$("#file").change(function(){

    $("button").prop("disabled", this.files.length == 0);
});




//--Fin de validaciones-------------------

//-----------Cargar la lista de usuarios depedniendo del perfil----------

    $("#id_tip").change(function() {

      $("#id_tip option:selected").each(function() {

          id_tip = $('#id_tip').val();

          $.post("<?php echo base_url();?>C_Horarios/cargar_usuarios", {

          id_tip : id_tip

          },

        function(data) {

          $("#rut_usu").html(data);

          });
      });
  });

//---------------------fin de la funcion----------------------------------

//-------Enviamos los datos por Ajax -------------------------------------


$('#subida').submit(function() {

var url = "<?php echo base_url();?>C_Horarios/guardar_horario";

var formData = new FormData(document.getElementById("subida"));

$.ajax({

type: "POST",
cache: false,
contentType: false,
processData: false,
url: url,
data: formData,

success: function() {

  $("#modal_ingresar").modal();//LLAMOS AL MODAL QUE NOS MUESTRA EL MENSAJE
       //document.subida.reset(); //LIMPIAMOS TODOS LOS CAMPOS DEL FORMULARIO

       //Cuando este método se ejecuta, recupera el contenido de location.href,
//pero luego jQuery analiza el documento devuelto para encontrar el elemento con divId. Este elemento,
// junto con su contenido, se inserta en el elemento con un ID ( divId) de resultado,
// y el resto del documento recuperado se descarta.

 $("#resultado_tabla").load(location.href+" #resultado_tabla>*","");

$('#resultado_tabla').show();

            },

})

return false;

});


//-------Fin de el envio de datos-----------------------------------------


});

</script>


<div id="modal_ingresar" class="modal fade" role="dialog">

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
    <h3 class="page-header">Administrar Horarios</h3>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Formulario de Registro
      </div>
      <div class="panel-body">
          <form id="subida" name="subida">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Perfil</label>
                  <?= form_open(base_url().'C_Horarios/hacerAlgo'); ?>
                   <select class="form-control" id="id_tip" name="id_tip">
                     <option value="0" class="required">--Seleccione un Perfil--</option>
                     <?php foreach ($tipo as $i) {
                      echo '<option value="'. $i->id_tip .'">'. $i->descripcion_tip .'</option>';
                      }
                      ?>
                   </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Usuario</label>
                   <select class="form-control" id="rut_usu" name="rut_usu">
                     <option value="0">--Seleccione un Usuario--</option>
                   </select>
                   <span class="hide" id="msg_pn" style="color:red;">Este campo no puede quedar en blanco</span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Sede</label>
                     <input type="text" class="form-control" id="sector" name="sector" value="<?php echo $this->session->userdata('sucursal');?>" disabled>
                </div>
              </div>
              <div class="col-md-2">
               <div class="form-group" onload="new_clock()">

                  <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" style="visibility:hidden"  >
               </div>
             </div>
            </div>
            <div class="row">
              <div class="col-md-3">
               <div class="form-group">
                   <label>Seleccione un xlxs</label>
                   <input type="file" name="file" id="file" accept=".xlsx" class="form-control" >
                </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
                   <label>Fecha Ini.</label>
                   <input type="date" name="fecha_ini" id="fecha_ini" class="form-control" >
                </div>
               </div>
               <div class="col-md-3">
              <div class="form-group">
                  <label>Fecha Ter.</label>
                  <input type="date" name="fecha_ter" id="fecha_ter" class="form-control" >
               </div>
              </div>
              <div class="col-md-3" style="top:25px; left: 30px;" >
                <div class="form-group">
                  <button type="button" name="cancelar" id="cancelar" class="btn btn-default" style="width:80px;">Cancelar</button>
                  <button type="submit" class="btn btn-primary" id="ingresar" name="ingresar" >Ingresar</button>
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>





<div class="row" hidden id="resultado_tabla" name="resultado_tabla">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Horario Ingresado</h3>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" >
              <table class="table table-hover" >

                <tbody>

                <tr>
                  <th style="text-align:center;">HRS.Ini</th>
                  <th style="text-align:center;">HRS.Ter</th>
                  <th style="text-align:center;">LUNES</th>
                  <th style="text-align:center;">MARTES</th>
                  <th style="text-align:center;">MIERCOLES</th>
                  <th style="text-align:center;">JUEVES</th>
                  <th style="text-align:center;">VIERNES</th>
                  <th style="text-align:center;">SABADO</th>
                </tr>

           <?php foreach($table as $row){?>

               <tr>
                  <td style="text-align:center;"><?php echo $row->hrs_ini ;?></td>
                  <td style="text-align:center;"><?php echo $row->hrs_ter ;?></td>
                  <td style="text-align:center;"><?php echo $row->lunes ;?></td>
                  <td style="text-align:center;"><?php echo $row->martes ;?></td>
                  <td style="text-align:center;"><?php echo $row->miercoles ;?></td>
                  <td style="text-align:center;"><?php echo $row->jueves;?></td>
                  <td style="text-align:center;"><?php echo $row->viernes ;?></td>
                  <td style="text-align:center;"><?php echo $row->sabado;?></td>

               </tr>

           <?php }?>



              </tbody>

            </table>
            </div>
