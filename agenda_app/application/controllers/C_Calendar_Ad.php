<?php


class C_Calendar_Ad extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		$this->load->model('M_Calendar_Ad');
		$this->lang->load('form_validation', 'english');
	}

	public function index() {

       $user = $this->session->userdata('s_usuario');
       $sucursal = $this->session->userdata('id_suc');
      if (empty($user)){

         $data['mensaje'] = '';
         $this->load->view('V_Login',$data);

        }

    else {
            $this->load->view('layouts/Header.php');
            $data['menu_barra'] = $this->M_Login->mostrar_menu();
            $this->load->view('layouts/Menu.php', $data);
             //cargamos el listbox
            $this->load->model('M_Calendar');
            
            $data['horarios'] = $this->gethorarios();
            $data['sucursales'] = $this->M_Calendar_Ad->sucursales();
            $data['usuarios'] = $this->M_Calendar->get_usuarios();
            //$data['estudiante'] = $this->M_Calendar->get_estudiante();
            $data2['motivos'] = $this->M_Calendar_Ad->get_motivos();
            
            $this->load->view('usuarios/V_Consulta_Horarios_Ad.php',$data,$data2);
            $this->load->view('layouts/Footer.php');
            
          }
	}

    public function geteventos(){
        //$start = $this->input->post('start');
        //$end = $this->input->post('end');
        $rut_usu = $this->input->post('rut_jc');
        $r = $this->M_Calendar_Ad->geteventos($rut_usu);
        echo json_encode($r); 
    }

    protected function gethorarios(){
        $rut_jc = $this->input->post('s_rut');
        if (empty($rut_jc)) {
            $rut_jc = $this->session->userdata('s_rut');
        }
        $monday = $this->M_Calendar_Ad->monday($rut_jc); 
        $monday_array = $this->_getHorario($monday, 1);
        $tuesday = $this->M_Calendar_Ad->tuesday($rut_jc); 
        $tuesday_array = $this->_getHorario($tuesday, 2);
        $wednesday = $this->M_Calendar_Ad->wednesday($rut_jc); 
        $wednesday_array = $this->_getHorario($wednesday, 3);
        $thursday = $this->M_Calendar_Ad->thursday($rut_jc); 
        $thursday_array = $this->_getHorario($thursday, 4);
        $friday = $this->M_Calendar_Ad->friday($rut_jc); 
        $friday_array = $this->_getHorario($friday, 5);
        $saturday = $this->M_Calendar_Ad->saturday($rut_jc); 
        $saturday_array = $this->_getHorario($saturday, 6);
        $horarios_array = array_merge($monday_array, $tuesday_array, $wednesday_array, $thursday_array, $friday_array, $saturday_array);
        return json_encode($horarios_array); 
    }

    public function getjsonhorarios(){
        echo $this->gethorarios(); 
    }
    
    protected function _getHorario($scheduleCol, $dayNumber) {
        $schedules_array = array();
        foreach($scheduleCol as $row) {
            $schedules_array[] = array(
                "dow" => [$dayNumber],
                "start" => $row->hrs_ini,
                "end" => $row->hrs_ter 
            );
        }
        return $schedules_array;
    }

    public function monday(){


    	$rut_jc = $this->input->post('rut_jc');

      $r = $this->M_Calendar_Ad->monday($rut_jc);
      echo json_encode($r);


    }

	public function buscar_estudiante(){


		$rut_estu = $this->input->post('rut_estu');
        $this->M_Calendar_Ad->buscar_estudiante($rut_estu);
       
	}

	public function insertar_cita(){
          
	   $rut_usu = $this->input->post('rut_usu');
           $estudiante= $this->input->post('rut_estu');

      

          $data = array(

          'rut_usu'=> $this->input->post('rut_usu'),
          'rut_estu'=> $this->input->post('rut_estu'),
          'id_mot'=> $this->input->post('id_mot'),
          'fecha_ini'=> $this->input->post('fecha_ini'),
          'fecha_ter'=> $this->input->post('fecha_ter'),
          'id_suc'=> $this->input->post('id_suc'),

              
             );
 
       $this->load->model('M_Calendar_Ad');
       $this->M_Calendar_Ad->insertar_cita($data,$rut_usu,$estudiante);
       
     $this->session->set_flashdata("flashSuccess", "Cita registrada con exito");
     $this->session->set_flashdata("emailSuccess", "Se ha enviado email de notificacion con exito");
                //$this->session->set_flashdata("flashError", "Some error found");


                    /*  $resp = $this->M_Calendar_Ad->insertar_cita($data,$rut_usu); 
                            if($resp){
                                $this->session->set_flashdata('success', 'Cita registrada con éxito');
                                //redirect(base_url('empleado/index'));
                            }



                        if($resp){
                           echo('<p> Cita registrada con exito, gracias.    </p>');

                        }

                        else{

                             echo('<p> Upss.    </p>');
                        }*/
	redirect('C_Calendar_Ad/index');
	}


	public function editar_cita(){

        $rut_usu = $this->input->post('rut_usu');
	    $id_ci = $this->input->post('event_id');


        $data = array(

    
          'id_mot'=> $this->input->post('id_mot2'),
          'fecha_ini'=> $this->input->post('start_f'),
          'fecha_ter'=> $this->input->post('end_f'),

              
           );

        $this->load->model('M_Calendar');
        $this->M_Calendar_Ad->editar_cita($data, $id_ci,$rut_usu);
	}



      public function cargar_usuarios() {

        $id_suc = $this->input->post('id_suc');
        
        if($id_suc){

            $this->load->model('M_Calendar_Ad');
            $usuarios = $this->M_Calendar_Ad->get_usuario($id_suc);

            echo '<option value="0">---Seleccione un Docente---</option>';

            foreach($usuarios as $fila){

                echo '<option value="'. $fila->rut.'">'. $fila->nom .' '. $fila->pat .' '.$fila->mat.'</option>';
            }

        }  

        else {

            echo '<option value="0">---Seleccione un Jefe de Carrera---</option>';
        }
    }

    public function hacerAlgo() {

        $id_suc = $this->input->post('id_suc');
        $rut_jc = $this->input->post('rut_jc');

        
        echo 'id_suc= '. $id_suc. '; rut_jc = '. $rut_jc;
    }



}

?>