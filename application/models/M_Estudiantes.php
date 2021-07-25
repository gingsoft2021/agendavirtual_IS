<?php


class M_Estudiantes extends CI_Model{

function __construct(){

	parent::__construct();

}

public function obtener_estudiante($cedula){

  $this->db->select('rut_estu');
  $this->db->from('estudiantes');
  //$this->db->order_by('descripcion_tip', 'asc');
  
  $tipos_cuenta = $this->db->get();

  if($tipos_cuenta->num_rows() > 0 ){
   return $tipos_cuenta->result();
  }
}

public function list_estudiantes(){

 
		        $query = $this->db->get('estudiantes');
		        return $query->result_array();
		   
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

public function create_estudiante(){
                    $data = array(
                     'rut_estu' => $this->input->post('rut_estu'), 
                    'pnombre' => $this->input->post('pnombre'),
                     'snombre' => $this->input->post('snombre'),
                     'apellido_pa' => $this->input->post('apellido_pa'),
                     'apellido_ma' => $this->input->post('apellido_ma'),
                      'fono_estu' => $this->input->post('fono_estu'),
                      'correo_estu' => $this->input->post('correo_estu')

                                );
			return $this->db->insert('estudiantes', $data);

}

public function consultar_rut($rut_usu){

 /*$query = $this->db->query("SELECT rut_estu FROM estudiantes WHERE rut_estu='$rut_usu'");
 $usuario = $query->row();*/

 /*if(empty($usuario)) {     return false;} //Si existe devolvemos false
 else {     return true; }//Si no existe, true.*/
 $query = $this->db->get_where('estudiantes', array('rut_estu' => $rut_usu));
		    return $query->row_array();
    
}

public function consultar_correo($correo_usu){

$query = $this->db->get_where('estudiantes', array('correo_estu' => $correo_usu));
		    return $query->row_array();
}

public function listar_usuarios(){

 $this->db->select('usuarios.rut_usu as Rut, CONCAT(usuarios.pnombre, " ", usuarios.apellido_pa, " " ,usuarios.apellido_ma) As Nombre, sucursales.nombre_suc As Sucursal, usuarios.estado AS Estado, usuarios.id_suc AS Id_sucursal, usuarios.id_tip AS Id_cuenta, tipo_cuenta.descripcion_tip AS Cuenta')->from('usuarios');
 $this->db->join('sucursales', 'usuarios.id_suc = sucursales.id_suc');
 $this->db->join('tipo_cuenta', 'usuarios.id_tip = tipo_cuenta.id_tip');
 $r = $this->db->get();
 $rs = $r->result();
 return $rs;
}

public function editar_cuenta($data, $rut_usu){

$this->db->where('rut_usu', $rut_usu);
$this->db->update('usuarios',$data);

}

public function editar_perfil($data, $rut_usu){

	$this->db->where('rut_usu', $rut_usu);
	$this->db->update('usuarios',$data);

}

public function elimina_estudiante($rut_usu){

	$this->db->where('rut_estu', $rut_usu);
	$this->db->delete('estudiantes');

}

public function actualiza_estudiante($cedula)
		{
		    
		  $cedula= strtolower($this->input->post('rut_estu'));
		  $nombre1= strtolower($this->input->post('pnombre'));
                  $nombre2= strtolower($this->input->post('snombre'));
                   $apellido_pa= strtolower($this->input->post('apellido_pa'));
		   $apellido_ma= strtolower($this->input->post('apellido_ma'));
		   $fono_estu= strtolower($this->input->post('fono_estu')); 
		   $correo_estu= strtolower($this->input->post('correo_estu'));
		    $this->db->set('rut_estu', $cedula);
		    $this->db->set('pnombre', $nombre1);
                     $this->db->set('snombre', $nombre2);
		     $this->db->set('apellido_pa', $apellido_pa);
                     $this->db->set('apellido_ma', $apellido_ma);
                     $this->db->set('fono_estu', $fono_estu);
                     $this->db->set('correo_estu', $correo_estu);
		    
		    $this->db->where('rut_estu', $cedula);
		    $result = $this->db->update('estudiantes');
		    return $result;
		    
		    $this->db->flush_cache();
		    
		}


}//FIn del Model

?>
