<?php


class C_Administrar_Usuarios extends  CI_Controller{

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
   $data['tipos_cuenta'] = $this->M_Usuarios->tipos_cuenta();
   $data['sucursales'] = $this->M_Usuarios->sucursales();
   $this->load->view('usuarios/V_Administrar_Usuarios.php',$data);
   $this->load->view('layouts/Footer.php');
        }
}

public function editar_cuenta(){

  $rut_usu = $this->input->post('rut_usu');
  $data = array(
    'id_tip'=> $this->input->post('id_tip'),
    'id_suc'=> $this->input->post('id_suc'),
    'estado'=> $this->input->post('estado'),
  );
  $this->M_Usuarios->editar_cuenta($data, $rut_usu);

}

public function listar_usuarios(){
  echo json_encode($this->M_Usuarios->listar_usuarios());
}

}// Din del Controlador

?>
