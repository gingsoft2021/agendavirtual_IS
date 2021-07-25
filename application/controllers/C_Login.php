<?php
class C_Login extends  CI_Controller{
            function __construct(){
            parent::__construct();
            $this->load->model('M_Login');
            }
public function index(){
$data['mensaje'] = '';
$this->load->view('V_Login',$data);
}
public function ingresar(){


$nombre_usu= $this->input->post('nombre_usu');
$pass_usu= $this->input->post('pass_usu');
$res= $this->M_Login->ingresar($nombre_usu,$pass_usu);
$id_tip= $this->session->userdata('tipo');
$estado= $this->session->userdata('estado');

if ($res == 1 && $id_tip == 2 && $estado == 'Activada'){

$this->load->view('layouts/Header.php');
$data['menu_barra'] = $this->M_Login->mostrar_menu();
$this->load->view('layouts/Menu.php', $data);

$this->load->model('M_Citas');
$data2['monday'] = $this->M_Citas->monday();
$data2['tuesday'] = $this->M_Citas->tuesday();
$data2['wednesday'] = $this->M_Citas->wednesday(); 
$data2['thursday'] = $this->M_Citas->thursday(); 
$data2['friday'] = $this->M_Citas->friday();  
$data2['saturday'] = $this->M_Citas->saturday(); 
$this->load->view('usuarios/V_Consultar_Citas.php',$data2);
$this->load->view('layouts/Footer.php');

} 

else if ($res == 1 && $id_tip == 9  && $estado == 'Activada' ){

$this->load->view('layouts/Header.php');
$data['menu_barra'] = $this->M_Login->mostrar_menu();
$this->load->view('layouts/Menu.php', $data);


$this->load->view('usuarios/V_Bienvenido.php');
$this->load->view('layouts/Footer.php');

} 

else if ($res == 1 && $id_tip == 7  && $estado == 'Activada'){

$this->load->view('layouts/Header.php');
$data['menu_barra'] = $this->M_Login->mostrar_menu();
$this->load->view('layouts/Menu.php', $data);


$this->load->view('usuarios/V_Bienvenido.php');
$this->load->view('layouts/Footer.php');

} 


else if ($res == 1 && $id_tip == 6  && $estado == 'Activada'){

$this->load->view('layouts/Header.php');
$data['menu_barra'] = $this->M_Login->mostrar_menu();
$this->load->view('layouts/Menu.php', $data);

$this->load->model('M_Calendar');
$data1['horarios'] = $this->gethorarios();
$data1['usuarios'] = $this->M_Calendar->get_usuarios();
$data2['motivos'] = $this->M_Calendar->get_motivos();
$this->load->view('usuarios/V_Consulta_Horarios.php',$data1,$data2);

$this->load->view('layouts/Footer.php');

} 


else {
$data['mensaje'] = "Usuario o contraseña Incorrecta";
$this->load->view('V_Login',$data);

   }
}

protected function gethorarios(){

$rut_jc = $this->input->post('s_rut');

if (empty($rut_jc)) {

$rut_jc = $this->session->userdata('s_rut');

}
        
$monday = $this->M_Calendar->monday($rut_jc); 
$monday_array = $this->_getHorario($monday, 1);
$tuesday = $this->M_Calendar->tuesday($rut_jc); 
$tuesday_array = $this->_getHorario($tuesday, 2);
$wednesday = $this->M_Calendar->wednesday($rut_jc); 
$wednesday_array = $this->_getHorario($wednesday, 3);
$thursday = $this->M_Calendar->thursday($rut_jc); 
$thursday_array = $this->_getHorario($thursday, 4);
$friday = $this->M_Calendar->friday($rut_jc); 
$friday_array = $this->_getHorario($friday, 5);
$saturday = $this->M_Calendar->saturday($rut_jc); 
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

public function salir(){
$this->session->sess_destroy();
$data['mensaje'] = 'Gracias por preferirnos';
$this->load->view('V_Login',$data);
}





}
?>