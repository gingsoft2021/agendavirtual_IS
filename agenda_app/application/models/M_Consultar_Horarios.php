<?php


class M_Consultar_Horarios extends CI_Model{

	
   function __construct(){


	parent::__construct();
   

   }


  public function get_tipos() {

        $this->db->order_by('descripcion_tip', 'asc');
        $this->db->where('id_tip=2 or id_tip=8');
        $tipo = $this->db->get('tipo_cuenta');
        
        if($tipo->num_rows() > 0){
            return $tipo->result();
        }
    }
    

    
   public function get_usuario($id_tip){
    
    $sucursales = $this->session->userdata('id_suc');
      
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('id_tip', $id_tip);
    $this->db->where('usuarios.id_suc',$sucursales);
    $usuarios = $this->db->get();

    if($usuarios->num_rows() > 0 ){
    
    return $usuarios->result();

      }
   
    
   }


    public function buscar_horario ($fecha_ini, $fecha_ter,$rut_usu){
     
   


    $consulta = $this->db->query("select * from (
     SELECT  hrs_ini ,hrs_ter , lunes, martes, miercoles, jueves, viernes, sabado,
     fecha_registro, id_hr
     FROM horario
     INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
     WHERE usuarios.rut_usu= '$rut_usu' AND date(horario.fecha_ini) BETWEEN date('$fecha_ini') AND date('$fecha_ter') AND 
     fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_usu' ) ORDER BY id_hr DESC LIMIT 14
     ) tmp order by tmp.id_hr asc");

    return $consulta->result();
    

    }





}

?>