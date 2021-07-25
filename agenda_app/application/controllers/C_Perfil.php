<?php


class C_Perfil extends  CI_Controller{

function __construct(){

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
   $this->load->view('usuarios/V_Perfil.php',$data);
   $this->load->view('layouts/Footer.php');
        }
}

public function editar_perfil(){

  $rut_usu = $this->input->post('rut_usu');
  $data = array(
    'correo_usu'=> $this->input->post('correo_usu'),
    'pass_usu'=> $this->input->post('pass_usu'),
   );
   $this->M_Usuarios->editar_perfil($data, $rut_usu);
}

}// Fin del Controlador

?>
