<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once APPPATH.'/third_party/PHPMailer/src/Exception.php';
require_once APPPATH.'/third_party/PHPMailer/src/PHPMailer.php';
require_once APPPATH. '/third_party/PHPMailer/src/SMTP.php';


class M_Calendar_Ad extends CI_Model
{

   public $variable;
  
function __construct()
{
  parent::__construct();
  $this->load->library('email');
       
  
}

  
  //function para traer los Jefes de Carrera

  public function get_usuario($id_suc){
      

    
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('sucursales.id_suc', $id_suc);
    $this->db->where('usuarios.id_tip="2"');
    $usuarios = $this->db->get();

    if($usuarios->num_rows() > 0 ){
    
    return $usuarios->result();

      }
   
    
   }
   
   public function get_estudiante($id_estudiante){
      

    
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('sucursales.id_suc', $id_suc);
    $this->db->where('usuarios.id_tip="2"');
    $usuarios = $this->db->get();

    if($usuarios->num_rows() > 0 ){
    
    return $usuarios->result();

      }
   
    
   }


    public function sucursales(){

    $this->db->select('id_suc, nombre_suc');
    $this->db->from('sucursales');
    $this->db->order_by('nombre_suc', 'asc');
    $sucursales = $this->db->get();

      if($sucursales->num_rows() > 0 ){
    
        return $sucursales->result();

      }
  }


   

   //Funcion para traer los motivos de las citas
    
   public function get_motivos() {

     $this->db->select('id_mot, descripcion_mot');
     $this->db->from('motivos_citas');
     $this->db->order_by('descripcion_mot', 'asc');
     $motivos = $this->db->get();

      if($motivos->num_rows() > 0 ){
    
        return $motivos->result();

        }
      }


  public function geteventos($rut_usu){


     $this->db->select('CONCAT(estudiantes.pnombre," ", estudiantes.apellido_pa," ", estudiantes.apellido_ma,", ",motivos_citas.descripcion_mot) As title ,citas.id_ci id, citas.fecha_ini start, citas.fecha_ter end, citas.id_mot mot, CONCAT(estudiantes.pnombre," ", estudiantes.apellido_pa," ", estudiantes.apellido_ma) as estudiante');
     $this->db->select('CONCAT(usuarios.pnombre," ", usuarios.apellido_pa," ", usuarios.apellido_ma) as jefe_c, estudiantes.rut_estu rut_estudiante');
     $this->db->from('citas');
     $this->db->join('estudiantes', 'citas.rut_estu = estudiantes.rut_estu');
     $this->db->join('motivos_citas','citas.id_mot = motivos_citas.id_mot');
     $this->db->join('usuarios','citas.rut_usu = usuarios.rut_usu');
     $this->db->where('usuarios.rut_usu', $rut_usu);

     return $this->db->get()->result();


  }

    public function buscar_estudiante($rut_estu){

      
      $this->db->select('CONCAT(pnombre, " ",apellido_pa," ", apellido_ma) As estudiante');
      $this->db->from('estudiantes');
      $this->db->where('rut_estu ',$rut_estu);
      $estudiante = $this->db->get()->row();

      if(empty($estudiante)) {echo false;} 
       else {echo   $estudiante->estudiante;}

    }

    public function insertar_cita($data,$rut_usu,$id_estudiante){

    $this->db->insert('citas', $data);
     
    $query = $this->db->query("SELECT correo_usu FROM usuarios 
    WHERE rut_usu='$rut_usu'");
    $correo = $query->row();
    
    $query = $this->db->query("SELECT correo_estu FROM estudiantes
    WHERE rut_estu='$id_estudiante'");
    $estudiante = $query->row();

      
    $config['protocol'] = 'smtp';
     $config['smtp_host'] = 'smtp.hostinger.com';
     $config['smtp_port'] = '465';
     $config['smtp_user'] = 'info@bysoftsl.com';
     $config['smtp_pass'] = '$Uafe2018';
     $config['smtp_crypto'] = 'ssl';
     $config['mailtype'] = 'text';
     $config['smtp_timeout'] = '4';
  //$config['mailpath'] = '/usr/sbin/sendmail';
  $config['charset'] = 'iso-8859-1';
  $config['wordwrap'] = TRUE;

  $this->email->initialize($config);

  $this->email->from('info@bysoftsl.com', 'DOCENTE UTPL');
  $this->email->to($estudiante->correo_estu);

  $this->email->subject('Cita - UNIVERSIDAD TECNICA PARTICULAR DE LOJA');
  $this->email->message('Gracias, usted ha registrado una Cita favor verificar en el sistema');

  $this->email->send();

     
    }

    public function editar_cita($data, $id_ci,$rut_usu){

    
    $this->db->where('id_ci', $id_ci);
    $this->db->update('citas', $data);
    
        $query = $this->db->query("SELECT correo_usu FROM usuarios 
    WHERE rut_usu='$rut_usu'");
    $correo = $query->row();

    $this->email->from("zuritabyron@gmail.com");
    $this->email->to($correo->correo_usu); //De esta forma toma bien el valor de la variable
    $this->email->subject("Cita Actualizada");
    $this->email->message("Se ha modificado una cita, revise el sistema de Agendacion de Citas");
    $this->email->send();


     }

    public function  monday($rut_jc) {
   
        $monday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.lunes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc ");
//print_r($this->db->last_query());
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($monday->num_rows() > 0 ){
            $first_row = $monday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $monday->result();
        }
        return $default_bh; //default array
    }




    public function  tuesday($rut_jc) {
       
        $tuesday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.martes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($tuesday->num_rows() > 0 ){
            $first_row = $tuesday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $tuesday->result();
        }
        return $default_bh; //default array
    }


    public function  wednesday($rut_jc) {
      
        $wednesday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.miercoles='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($wednesday->num_rows() > 0 ){
            $first_row = $wednesday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $wednesday->result();
        }
        return $default_bh; //default array
    }

    public function  thursday($rut_jc) {
        
        
        
        $thursday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.jueves='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($thursday->num_rows() > 0 ){
            $first_row = $thursday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $thursday->result();
        }
        return $default_bh; //default array
    }

    public function  friday($rut_jc) {
        
  
        $friday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.viernes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($friday->num_rows() > 0 ){
            $first_row = $friday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $friday->result();
        }
        return $default_bh; //default array
    }

    public function saturday($rut_jc) {
        
        $saturday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.sabado='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");
        $default_bh = array((object)array("hrs_ini" => "00:00", "hrs_ter" => "00:00"));
        if($saturday->num_rows() > 0 ){
            $first_row = $saturday->first_row();
            if (is_null($first_row->hrs_ini)) {
                return $default_bh; //default array
            }
            return $saturday->result();
        }
        return $default_bh; //default array
    }





    }
