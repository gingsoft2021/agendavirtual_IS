<?php




class C_Consultar_Horarios_Ad extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		$this->load->model('M_Consultar_Horarios_Ad');
 

	}

	public function index(){


	       $user = $this->session->userdata('s_usuario');

      if (empty($user)){

         $data['mensaje'] = '';
         $this->load->view('V_Login',$data);

        }
        
        else{ 
		    $this->load->view('layouts/Header.php');
            $data['menu_barra'] = $this->M_Login->mostrar_menu();
        	$this->load->view('layouts/Menu.php', $data);

            //$this->load->model('M_Consultar_Horarios');

           $data['tipo'] = $this->M_Consultar_Horarios_Ad->get_tipos();
           $data['sucursales'] = $this->M_Consultar_Horarios_Ad->sucursales();
            
       
            $this->load->view('usuarios/V_Consultar_Horarios_Ad.php', $data);
            $this->load->view('layouts/Footer.php');
        }
	}


    public function cargar_usuarios() {

        $id_tip = $this->input->post('id_tip');
        $id_suc = $this->input->post('id_suc');
        
        if($id_tip && $id_suc){

            $this->load->model('M_Consultar_Horarios_Ad');
            $usuarios = $this->M_Consultar_Horarios_Ad->get_usuario($id_tip, $id_suc);

            echo '<option value="0">--Seleccione un Usuario--</option>';

            foreach($usuarios as $fila){

                echo '<option value="'. $fila->rut.'">'. $fila->nom .' '. $fila->pat .' '.$fila->mat.'</option>';
            }

        }  

        else {

            echo '<option value="0">--Seleccione un Usuario--</option>';
        }
    }

    public function hacerAlgo() {

        $id_tip = $this->input->post('id_tip');
        $rut_usu = $this->input->post('rut_usu');

        
        echo 'id_tip= '. $id_tip. '; rut_usu = '. $rut_usu;
    }



public function buscar_horario(){
 

    $fecha_ini = $this->input->get('fecha_ini');
    $fecha_ter = $this->input->get('fecha_ter');
    $rut_usu = $this->input->get('rut_usu');

   $data['consulta'] = $this->M_Consultar_Horarios_Ad->buscar_horario($fecha_ini, $fecha_ter,$rut_usu);
   $this->load->view('usuarios/consultar_horario.php',$data);

}


  }// FIN CONTROLLLER


?>