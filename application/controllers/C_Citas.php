<?php


class C_Citas extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		$this->load->model('M_Citas');
		
	}

	public function index(){
            
       $user = $this->session->userdata('s_usuario');

      if (empty($user)){

         $data['mensaje'] = '';
         $this->load->view('V_Login',$data);

        }
           else {    $this->load->view('layouts/Header.php');
           $data['menu_barra'] = $this->M_Login->mostrar_menu();
            $this->load->view('layouts/Menu.php', $data);

            $this->load->model('M_Citas');

            $data['monday'] = $this->M_Citas->monday();
            $data['tuesday'] = $this->M_Citas->tuesday();
            $data['wednesday'] = $this->M_Citas->wednesday(); 
            $data['thursday'] = $this->M_Citas->thursday(); 
            $data['friday'] = $this->M_Citas->friday();  
            $data['saturday'] = $this->M_Citas->saturday(); 
   

            $this->load->view('usuarios/V_Consultar_Citas.php',$data);
            $this->load->view('layouts/Footer.php');}
		  
	}


	public function geteventos(){


    $r = $this->M_Citas->geteventos();
    echo json_encode($r);


    }




}

?>