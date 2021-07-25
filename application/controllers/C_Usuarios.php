<?php


class C_Usuarios extends  CI_Controller{
    
    function __construct()
    {
        parent::__construct();

        $this->load->model('M_Login');
        $this->load->model('M_Usuarios');
        
        
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
            
            $data['tipos_cuenta'] = $this->M_Usuarios->tipos_cuenta();
            $data['sucursales'] = $this->M_Usuarios->sucursales();
            $this->load->view('usuarios/V_Usuarios.php',$data);
            $this->load->view('layouts/Footer.php');
        }
    }

    public function insertar_usuario(){

        $data = array(

          'rut_usu'=> $this->input->post('rut_usu'),
          'nombre_usu'=> $this->input->post('nombre_usu'),
          'pnombre'=> $this->input->post('pnombre'),
          'snombre'=> $this->input->post('snombre'),
          'apellido_pa'=> $this->input->post('apellido_pa'),
          'apellido_ma'=> $this->input->post('apellido_ma'),
          'fono_usu'=> $this->input->post('fono_usu'),
          'correo_usu'=> $this->input->post('correo_usu'),
          'pass_usu'=> $this->input->post('pass_usu'),
          'id_tip'=> $this->input->post('id_tip'),
          'id_suc'=> $this->input->post('id_suc'),
          'estado'=> $this->input->post('estado'),

     
              
         );
        
        $this->M_Usuarios->insertar_usuario($data);


    }



    public function consultar_rut(){
        
        $rut_usu = $this->input->post('rut_usu');
        $this->M_Usuarios->consultar_rut($rut_usu);
    }

    public function consultar_correo(){
        
        $correo_usu = $this->input->post('correo_usu');
        $this->M_Usuarios->consultar_correo($correo_usu);
    }


}

?>