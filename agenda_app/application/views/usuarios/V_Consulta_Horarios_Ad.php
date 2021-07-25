<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url();?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/gcal.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/locale/es.js"></script>
<script src="<?php echo base_url();?>assets/rut/jquery.rut.js"></script>

<?php
    //var_dump($monday);die();
?>
<script type="text/javascript">

$(document).ready(function() {

//---------------------Full Calendar--------------------------------------
$('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,listWeek'
  },
  defaultView: 'agendaWeek',
  defaultDate: new Date(),
  //navLinks: true, // can click day/week names to navigate views
  businessHours: <?php echo $horarios; ?>,

events: function(start, end, timezone, callback) {
    $.post('<?php echo base_url(); ?>C_Calendar_Ad/geteventos', {
        //"start": start.format("YYYY-MM-DD"),
        //"end": end.format("YYYY-MM-DD"),
        "rut_jc": $("#rut_jc").val() //add the extra value to the existing filter parameters. fullCalendar can then use it directly.
      },
      function(data) {
        callback($.parseJSON(data));
      }
    );
  },

dayClick: function(date, jsEvent, view, start, end, allDay) {
    $('#modal_registrar').modal();
  },
eventClick: function(event, jsEvent, view) {
    $('#event_id').val(event.id);
    $('#id_mot2').val(event.mot);
    $('#nombre_estudiante').val(event.estudiante);
    $('#jc2').val(event.jefe_c);
    $('#rut_estudiante').val(event.rut_estudiante)
    $('#start_f').val(moment(event.start).format('YYYY-MM-DDTHH:mm'));
    $('#end_f').val(moment(event.end).format('YYYY-MM-DDTHH:mm'));
    $('#modal_editar').modal();
  },
eventDrop: function(event, delta, revertFunc) {
    if(event.start < currentDate) {
      revertFunc();
    }
},

  minTime: "08:00:00",
  maxTime: "18:00:00",

});
//--------------Fin fullcalendar-----------------

//---Buscar estudiante---------------------------

$("#btn_insert").prop("disabled", true);

$("#rut_estu").rut({

  formatOn: 'keyup',
  validateOn: 'change'

});

$("#rut_estu").keyup(function(){

  var parametros = {
  "rut_estu" :$("#rut_estu").val(),
  }
  $.ajax({
    data:  parametros,
    url:   '<?php echo base_url();?>C_Calendar/buscar_estudiante',
    type:  'post',
    success:  function (data) {
    if(data){ $("#nombre_estu").val(data);
    if ($("#id_mot").val() > 0 ) {
    $("#btn_insert").prop("disabled", false);
    }
 }
    else { $("#nombre_estu").val('Estudiante no encontrado');
     $("#btn_insert").prop("disabled", true);
    }

  }
 });
});

//---Fin buscar estudiante-----------------------

//---Pasar cedula y nombre del jc-------------------

$("#rut_jc").change(function(){
    $("#calendar").fullCalendar('refetchEvents');
    updateHorarios($("#rut_jc").val());
    var op=document.getElementById("rut_jc");
    if (op.selectedIndex > 0)$("#jc").val($( "#rut_jc option:selected" ).text());
    $("#rut_usu").val($("#rut_jc").val());
    $("#calendar").css({"visibility": "visible"});


    if (op.selectedIndex  < 1)$("#calendar").css({"visibility": "hidden"});
});

function updateHorarios(currentUser) {
    $.post('<?php echo base_url(); ?>C_Calendar_Ad/getjsonhorarios', {
            "s_rut": currentUser
        },
        function(data) {
            var json_data = $.parseJSON(data);
            $('#calendar').fullCalendar('option', {
                businessHours: json_data
            });
        }
    );
}

//--fin del traspaso-----------------------------
//---Registrar Cita------------------------------

  $("#btn_insert").click(function(){

    var rut_usu = $("#rut_usu").val();
    var rut_estu = $("#rut_estu").val();
    var id_mot = $("#id_mot").val();
    var fecha_ini = $("#fecha_ini").val();
    var fecha_ter = $("#fecha_ter").val();
    var id_suc = $("#id_suc").val();

    $.ajax({

     url: "<?php echo base_url(); ?>" + "C_Calendar_Ad/insertar_cita/",
     type: 'post',
     data: { "rut_usu": rut_usu, "rut_estu": rut_estu, "id_mot" : id_mot , "fecha_ini": fecha_ini , "fecha_ter": fecha_ter , "id_suc": id_suc },

     success: function(response){
         //alert('Se ha registrado correctamente su CITA');
           
         $("#modal_registrar").modal('hide');
           $("#modal_confirmar").modal('show');
        //actualizamos los eventos
           $("#calendar").fullCalendar('refetchEvents');

           $("#rut_estu").val("");
            $("#id_mot").val("");
            $("#fecha_ini").val("");
            $("#fecha_ter").val("");
            $("#nombre_estu").val("");
      }
      
});
    });
//--Fin del Registro-----------------------------

//--Actualizar Cita------------------------------
  $("#btn_editar").click(function(){

    var id_mot = $("#id_mot2").val();
    var fecha_ini = $("#start_f").val();
    var fecha_ter = $("#end_f").val();
    var rut_usu = $("#rut_usu").val();
    var id_ci = $("#event_id").val();

    $.ajax({

     url: "<?php echo base_url(); ?>" + "C_Calendar_Ad/editar_cita/",
     type: 'post',
     data: { "id_mot2": id_mot, "start_f": fecha_ini, "end_f" : fecha_ter , "event_id": id_ci ,"rut_usu": rut_usu},

     success: function(response){
           $("#modal_editar").modal('hide');
           $("#modal_confirmar").modal('show');
          //actualizamos los eventos
           $("#calendar").fullCalendar('refetchEvents');
      }

   });

 });
//--Fin de Actualizar----------------------------
//--Validar campos si estan vacios, bloquear boton--
  $("#form_registrar input").keyup(function() {
    var form = $(this).parents("#form_registrar");
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

  else if($("#nombre_estu").val() == "Estudiante no encontrado" ){

    return false;

   }
  else {
    return true;
  }
}
var start=document.querySelector('input[type="datetime-local"]#fecha_ini'), end = document.querySelector('input[type="datetime-local"]#fecha_ter')
start.value = start.value;
end.stepUp(20);

$("#fecha_ini").on("change click keyup", function(){
   end.value =  start.value;
   end.stepUp(20);
});


var start1=document.querySelector('input[type="datetime-local"]#start_f'), end1= document.querySelector('input[type="datetime-local"]#end_f')

start1.value = start1.value;
end1.stepUp(20);

$("#start_f").on("change click keyup", function(){
   end1.value =  start1.value;
   end1.stepUp(20);
});


$("#id_suc").change(function() {

 $("#calendar").css({"visibility": "hidden"});

$("#id_suc option:selected").each(function() {

id_suc = $('#id_suc').val();

$.post("<?php echo base_url();?>M_Calendar/get_usuarios", {

    id_suc : id_suc

  },

  function(data) {

      $("#rut_jc").html(data);

          });

      });

  });


//--Fin de validaciones-------------------

//--Validar Que la fecha no sea anterior a la de hoy--


 $("#calendar").css({"visibility": "hidden"});
//--Fin de la validacion de facha


});


</script>

 <!-- <?php          var_dump($_SESSION);   ?>  -->
<div id="modal_confirmar" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Mensaje de Confirmación</h4>
      </div>
      <div class="modal-body">
        <p>Datos Ingresados Correctamente</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Inicio del modal -->

<div class="modal fade" id="modal_registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:50px;">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registrar Citas</h4>
      </div>
      <div class="modal-body">
        <?php  $id_user = $_SESSION['s_rut'];                ?>
        <?php  $id_suc = $_SESSION['id_suc'];                ?>

         <div class="box-body">
              <?php echo form_open_multipart('C_Calendar_Ad/insertar_cita/', ' id="form_registrar" '); ?>
   <!-- <form  id="form_registrar" >  -->

            <div class="row">
               <div class="col-md-6">
                      <div class="form-group">
                        <label>Docente</label>
                        <input type="text" id="jc"  name="jc" class="form-control" disabled>
                      </div>
                </div>
                <div class="col-md-4">
                      <div class="form-group">

                          <input type="hidden" id="rut_usu1"  name="rut_usu"   value="<?php  echo $id_user;    ?>"class="form-control" >
                          <input type="hidden"   name="id_suc"   value="<?php  echo $id_suc;    ?>"class="form-control" >
                    </div>
                </div>
            </div>

           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cedula Estudiante/PP.FF. </label>
                        <input type="text" id="rut_estu" name="rut_estu" class="form-control"  placeholder="Ej. 1713003545" autofocus>
                        <span class="hide" id="msg_am" style="color:red;">Este campo no puede quedar en blanco</span>
                     </div>
                </div>
                <div class="col-md-7">
                     <div class="form-group">
                        <label>Nombre del Estudiante/PP.FF.</label>
                        <input type="text" id="nombre_estu" name="nombre_estu" class="form-control" disabled >
                     </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                     <label>Motivo de la Cita</label>

                        <?= form_open(base_url().'M_Calendar/get_motivos'); ?>
                        <select class="form-control" id="id_mot" name="id_mot">
                          <option>--Seleccione un Motivo--</option>
                         <?php

                             $this->load->model('M_Calendar');
                             $motivos = $this->M_Calendar->get_motivos();

                             foreach($motivos as $fila){

                             echo '<option value="'. $fila->id_mot.'">'. $fila->descripcion_mot .'</option>';

                             } ?>

                         </select>
                   </div>
                </div>
                  <div class="col-md-5">
                      <div class="form-group">
                        <label>Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_ini" name="fecha_ini" min="<?php echo  date('Y-m-d\TH:i'); ?>">
                      </div>
                   </div>
             </div>


              <div class="row">

                  <div class="col-md-5">
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" id="fecha_ter" name="fecha_ter" style="visibility:hidden;">
                    </div>
                </div>
              </div>



            </div>
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn_insert1" name="btn_insert" >Guardar</button>
      </div>

       </form>

     
       
                     

         <!--  <?php   if($this->session->flashdata('cita_send')){
           echo $this->session->flashdata('cita_send'); }  ?>   -->
                 

    </div>

  </div>
</div>

<!-- Fin del Modal -->


<!-- Inicio del modal -->

<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:50px;">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Citas</h4>
      </div>
      <div class="modal-body">


         <div class="box-body">

          <form id="form_Editar">
            <div class="row">
               <div class="col-md-6">
                      <div class="form-group">
                        <label>Docente</label>
                        <input type="text" id="jc2"  name="jc2" class="form-control" disabled>
                      </div>
                </div>
                <div class="col-md-1">
                      <div class="form-group">

                        <input  id="event_id"  name="event_id" class="form-control"   type="hidden" >
                    </div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Cedula del Estud./ PPFF </label>
                        <input type="text" id="rut_estudiante" name="rut_estudiante" class="form-control"  disabled>
                        <span class="hide" id="msg_am" style="color:red;">Este campo no puede quedar en blanco</span>
                     </div>
                </div>
                <div class="col-md-7">
                     <div class="form-group">
                        <label>Nombre del Estudiante | PPFF</label>
                        <input type="text" id="nombre_estudiante" name="nombre_estudiante" class="form-control" disabled >
                     </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                     <label>Motivo de la Cita</label>

                        <?= form_open(base_url().'M_Calendar/get_motivos'); ?>
                        <select class="form-control" id="id_mot2" name="id_mot2">
                          <option>--Seleccione un Motivo--</option>
                         <?php

                             $this->load->model('M_Calendar');
                             $motivos = $this->M_Calendar->get_motivos();

                             foreach($motivos as $fila){

                             echo '<option value="'. $fila->id_mot.'">'. $fila->descripcion_mot .'</option>';

                             } ?>

                         </select>
                   </div>
                </div>

                     <div class="col-md-5">
                      <div class="form-group">
                        <label>Hrs y Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="start_f" name="start_f">
                      </div>
                   </div>
             </div>


              <div class="row">

                  <div class="col-md-5">
                    <div class="form-group">

                        <input type="datetime-local" class="form-control" id="end_f" name="end_f" style="visibility:hidden;">
                    </div>
                </div>
              </div>



            </div>
                </div>

       </form>

      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn_editar" name="btn_editar" >Editar</button>
      </div>


    </div>

  </div>
</div>

<!-- Fin del Modal -->
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Agendar Citas</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Parámetros de Busqueda
      </div>
      <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <form id="jc">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Filtro de Horarios</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
     <div class="col-md-3">
        <div class="form-group">
          <label>Sede</label>
          <?= form_open(base_url().'C_Calendar_Ad/hacerAlgo'); ?>
           <select class="form-control" id="id_suc" name="id_suc">
             <option value="0" class="required">---Seleccione una Sede---</option>
             <?php
                    foreach ($sucursales as $i) {
                        echo '<option value="'. $i->id_suc .'">'. $i->nombre_suc .'</option>';
                    }
                ?>

           </select>
        </div>
      </div>
  <!-- <?php           var_dump($usuarios);    ?>   -->
            <div class="col-md-4">
        <div class="form-group">
          <label>Docente</label>
           <select class="form-control" id="rut_jc" name="rut_jc">
             <option value="0">---Seleccione un Docente---</option>
               <?php
                    foreach ($usuarios as $j) {
                        echo '<option value="'. $j->rut .'">'. $j->nom .'</option>';
                    }
                    
                    ?>

           </select>
           <span class="hide" id="msg_pn" style="color:red;">Este campo no puede quedar en blanco</span>
        </div>
      </div>
                <div class="col-md-4">
                 <div class="form-group">

                 <label style="color:#235c9c;">*Nota: Las horas de atencion estan representadas por los recuadros en blanco</label>
                </div>

              </div>


              <div class="col-md-2">
                 <div class="form-group">
                </div>
              </div>
            </div>
            <!-- /.box-body <php echo date("Y-m-d");?> -->
          </div>
          <!-- /. box -->
       </form>
        </div>
        <div class="col-md-12" id="calendario" name="calendario" >
          <div class="box">

            <!-- /.box-header -->
            <div  class="box-body" >
              <div class="row">
                <div class="col-md-12">

                 <div id="calendar" >
                </div>

                  <!-- /.chart-responsive -->
                </div>

              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
          </div>
              </div>
                  </div>
                      </div>
      <!-- /.row -->
