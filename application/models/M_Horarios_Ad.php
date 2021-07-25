<?php

/**
* 
*/
class M_Horarios_Ad extends CI_Model
{

   public $variable;
	
function __construct()
{
	parent::__construct();
}

  
  //function para traer los tipos de perfiles

  public function get_tipos() {

        $this->db->order_by('descripcion_tip', 'asc');
        $this->db->where('id_tip=2 or id_tip=8');
        $tipo = $this->db->get('tipo_cuenta');
        
        if($tipo->num_rows() > 0){
            return $tipo->result();
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



//function para traer los usuarios de acuerdo al perfil seleccionado
  public function get_usuario($id_tip,$id_suc){
      
      
    $this->db->select('rut_usu as rut, pnombre as nom,apellido_pa as pat, apellido_ma as mat');
    $this->db->from('usuarios');
    $this->db->join('sucursales','sucursales.id_suc=usuarios.id_suc');
    $this->db->where('id_tip', $id_tip);
    $this->db->where('usuarios.id_suc',$id_suc);
    $usuarios = $this->db->get();

    if($usuarios->num_rows() > 0 ){
    
    return $usuarios->result();

      }
   
    
   }


    public function mostrar_tabla(){


    $table = $this->db->query("select * from (
    SELECT id_hr, hrs_ini, hrs_ter, lunes, martes, miercoles, jueves, viernes, sabado, 
    fecha_registro
    FROM horario
    INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
    WHERE fecha_registro = (SELECT MAX(fecha_registro) FROM horario) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc ");

      if($table->num_rows() > 0 ){
    
       return $table->result();

      }


   }


  

}

?>