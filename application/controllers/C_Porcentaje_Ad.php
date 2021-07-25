<?php


class C_Porcentaje_Ad extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');
		 $this->load->model('M_Porcentaje_Ad');
		
		
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

            $data['sucursales'] = $this->M_Porcentaje_Ad->sucursales();

            $this->load->view('usuarios/V_Citas_Porcentaje_Ad.php', $data);
            $this->load->view('layouts/Footer.php');
        }
	}


    public function tabla_porcentaje(){


    $fecha_ini = $this->input->get('fecha_ini');
    $fecha_ter = $this->input->get('fecha_ter');
    $rut_usu = $this->input->get('rut_usu');
    $id_suc = $this->input->get('id_suc');

    $data['consulta'] = $this->M_Porcentaje_Ad->tabla_porcentaje($fecha_ini, $fecha_ter,$rut_usu, $id_suc);
    $data['total'] = $this->M_Porcentaje_Ad->mostrar_total($fecha_ini, $fecha_ter, $rut_usu, $id_suc);
    $this->load->view('usuarios/test.php',$data);


            
            
	 }


        public function cargar_usuarios() {

        $id_suc = $this->input->post('id_suc');
        
        if($id_suc){

            $this->load->model('M_Porcentaje_Ad');
            $usuarios = $this->M_Porcentaje_Ad->get_usuario($id_suc);

            echo '<option value="0">Todos</option>';

            foreach($usuarios as $fila){

                echo '<option value="'. $fila->rut.'">'. $fila->nom .' '. $fila->pat .' '.$fila->mat.'</option>';
            }

        }  

        else {

            echo '<option value="0">Todos</option>';
        }
    }

    public function hacerAlgo() {

        $id_suc = $this->input->post('id_suc');
        $rut_usu = $this->input->post('rut_usu');

        
        echo 'id_suc= '. $id_suc. '; rut_usu = '. $rut_usu;
    }






}

?>