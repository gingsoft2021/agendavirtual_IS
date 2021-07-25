<?php


class C_Porcentaje extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		 $this->load->model('M_Porcentaje');
		
		
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

            $this->load->model('M_Porcentaje');
            $data['usuarios'] = $this->M_Porcentaje->get_usuarios();

            $this->load->view('usuarios/V_Citas_Porcentaje.php', $data);
            $this->load->view('layouts/Footer.php');
        }
	}


    public function tabla_porcentaje(){


    $fecha_ini = $this->input->get('fecha_ini');
    $fecha_ter = $this->input->get('fecha_ter');
    $rut_usu = $this->input->get('rut_usu');

    $data['consulta'] = $this->M_Porcentaje->tabla_porcentaje($fecha_ini, $fecha_ter,$rut_usu);
    $data['total'] = $this->M_Porcentaje->mostrar_total($fecha_ini, $fecha_ter, $rut_usu);
    $this->load->view('usuarios/test.php',$data);


            
            
	 }






}

?>