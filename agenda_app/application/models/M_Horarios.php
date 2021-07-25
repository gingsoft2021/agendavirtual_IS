<?php

/**
* 
*/
class M_Horarios extends CI_Model
{

   public $variable;
	
function __construct()
{
	parent::__construct();
}

  
  //function para traer los tipos de perfiles

  public function get_tipos() {

        $this->db->order_by('descripcion_tip', 'asc');
        $this->db->where('id_tip=7 or id_tip=9 or id_tip!=0');
        $tipo = $this->db->get('tipo_cuenta');
        
        if($tipo->num_rows() > 0){
            return $tipo->result();
        }
    }



//function para traer los usuarios de acuerdo al perfil seleccionado
  public function get_usuario($id_tip){
      
      $sede=$this->session->userdata('sucursal');
    
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('id_tip', $id_tip);
    $this->db->where('nombre_suc',$sede);
    $usuarios = $this->db->get();

    if($usuarios->num_rows() > 0 ){
    
    return $usuarios->result();

      }
   
    
   }


    public function mostrar_tabla(){

    $this->db->select('hrs_ini, hrs_ter, lunes, martes, miercoles, jueves, viernes, sabado, fecha_registro');
    $this->db->from('horario');
    $this->db->join('usuarios','horario.rut_usu = usuarios.rut_usu');
    $this->db->where('fecha_registro = (SELECT MAX(fecha_registro) FROM horario)');
    $this->db->limit('14');
    $table = $this->db->get();

      if($table->num_rows() > 0 ){
    
       return $table->result();

      }


   }


  

}

?>