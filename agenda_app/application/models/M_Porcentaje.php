<?php

class M_Porcentaje extends CI_Model{

	
   function __construct(){


	parent::__construct();
   

   }


    public function get_usuarios() {


    $sucursal= $this->session->userdata('id_suc');
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('id_tip=2');
    $this->db->where('sucursales.id_suc',$sucursal);
    $this->db->order_by('pnombre', 'asc');
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

    public function tabla_porcentaje ($fecha_ini, $fecha_ter, $rut_usu){
    
    if ($rut_usu == '0') {

    $sucursales = $this->session->userdata('id_suc');
    $this->db->select("motivos_citas.descripcion_mot,COUNT(*) AS cantidad_motivos,ROUND((SELECT COUNT(motivos_citas.descripcion_mot)* 100 / COUNT(citas.id_ci) FROM citas AS citas WHERE date(citas.fecha_ini) BETWEEN date('$fecha_ini') AND date('$fecha_ter') ),2)  AS porcentaje");
    $this->db->from("citas");
    $this->db->join("motivos_citas","citas.id_mot=motivos_citas.id_mot");
    $this->db->where("date(citas.fecha_ini) BETWEEN date('$fecha_ini') AND date('$fecha_ter') ");
    $this->db->where("citas.id_suc", $sucursales);
    $this->db->group_by("motivos_citas.descripcion_mot");
    $consulta = $this->db->get();

     return $consulta->result();
    
    }

    else {  


    $sucursales = $this->session->userdata('id_suc');
    
    $this->db->select("motivos_citas.descripcion_mot,COUNT(*) AS
    cantidad_motivos, ROUND((SELECT COUNT(motivos_citas.descripcion_mot)* 100 / COUNT(citas.id_ci) FROM citas AS citas WHERE date(citas.fecha_ini) BETWEEN date('$fecha_ini') AND date('$fecha_ter') AND rut_usu='$rut_usu'),2) AS porcentaje");
    $this->db->from("citas");
    $this->db->join("motivos_citas","citas.id_mot=motivos_citas.id_mot");
    $this->db->where("date(citas.fecha_ini) BETWEEN date('$fecha_ini') AND date('$fecha_ter') ");
    $this->db->where("citas.rut_usu", $rut_usu);
    //$this->db->where("sucursales.id_suc", $sucursales);
    $this->db->group_by("motivos_citas.descripcion_mot");
    $consulta = $this->db->get();

     return $consulta->result();

    }


     
    }

    public function mostrar_total($fecha_ini, $fecha_ter, $rut_usu){
     
    if ($rut_usu == '0'){

    $sucursales = $this->session->userdata('id_suc');
    
     $this->db->select("COUNT(motivos_citas.id_mot) AS total");
     $this->db->from("citas");
     $this->db->join("motivos_citas", "citas.id_mot = motivos_citas.id_mot");
     $this->db->where("citas.fecha_ini BETWEEN '$fecha_ini 08:30:00' AND  '$fecha_ter 22:30:00' ");
     $this->db->where("citas.id_suc", $sucursales);
     $total = $this->db->get();

     return $total->result();


    }

    else {

    $sucursales = $this->session->userdata('id_suc');

     $this->db->select("COUNT(motivos_citas.id_mot) AS total");
     $this->db->from("citas");
     $this->db->join("motivos_citas", "citas.id_mot = motivos_citas.id_mot");
     $this->db->where("citas.fecha_ini BETWEEN '$fecha_ini 08:30:00' AND  '$fecha_ter 22:30:00' ");
     $this->db->where("citas.rut_usu", $rut_usu);
     $this->db->where("citas.id_suc", $sucursales);
     $total = $this->db->get();

     return $total->result();


    }
    


    }


  

}

?>