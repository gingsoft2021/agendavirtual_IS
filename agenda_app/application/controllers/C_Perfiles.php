<?php


class C_Perfiles extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		$this->load->model('M_Perfiles');
		
		
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
            
            $data['tabla'] = $this->M_Perfiles->mantenedores();
            $data['opciones'] = $this->M_Perfiles->mostrar_permisos();
            $this->load->view('usuarios/V_Tipo_Cuentas.php',$data);
            $this->load->view('layouts/Footer.php');
        }
	}

	public function insertar_perfil(){

         //$descripcion_tip = $this->input->post('descripcion_tip');

          $data = array(

          'descripcion_tip'=> $this->input->post('descripcion_tip'),
              
             );

         $this->M_Perfiles->insertar_perfil($data);
	}


    public function insertar_permisos(){

         $descripcion_tip = $this->input->post('descripcion_tip');
         $id_man = $this->input->post('id_man');

  

         $this->M_Perfiles->insertar_permisos($descripcion_tip, $id_man);
	}






}

?>