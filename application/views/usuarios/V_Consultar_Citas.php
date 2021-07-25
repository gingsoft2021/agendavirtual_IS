<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url() ?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/gcal.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/locale/es.js"></script>

<script type="text/javascript">


     //---------------------Full Calendar--------------------------------------
$(document).ready(function() {



	    $.post('<?php echo base_url();?>C_Citas/geteventos',

	    function(data){

        	$('#calendar').fullCalendar({

			    header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,listWeek'

			  },

		    defaultView: 'agendaWeek',

			defaultDate: new Date(),
			navLinks: true, // can click day/week names to navigate views
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: $.parseJSON(data),

			businessHours: [


             {  dow: [ 1], // lunes

            <?php foreach($monday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },

             {  dow: [ 2], // martes
            <?php foreach($tuesday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },

             {  dow: [ 3], // miercoles
            <?php foreach($wednesday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },


            {  dow: [ 4], // jueves
            <?php foreach($thursday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },

             {  dow: [ 5], // viernes
            <?php foreach($friday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },


             {  dow: [ 6], // viernes
            <?php foreach($saturday as $row){?>
            start: '<?php  $inicio= "00:00"; $start1_ok = $row->hrs_ini;
             if (empty($start1_ok)) { echo $inicio;}

             else { echo $start1_ok;} ?>',  // empty evalua si el campo se encuentra vacio o si es cero
             end: '<?php  echo $row->hrs_ter ; ?>'
             <?php }?>

             },

             ],

			minTime: "08:30:00",
			maxTime: "23:00:00",




		});

});

//--------------Fin fullcalendar-----------------


	});

</script>



<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Citas Agendadas</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Calendario de Citas
      </div>
      <div class="panel-body">

      <div class="row">

        <div class="col-md-12">

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
