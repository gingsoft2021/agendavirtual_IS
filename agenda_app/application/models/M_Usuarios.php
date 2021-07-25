<?php


class M_Usuarios extends CI_Model{

function __construct(){

	parent::__construct();

}

public function tipos_cuenta(){

  $this->db->select('id_tip, descripcion_tip');
  $this->db->from('tipo_cuenta');
  $this->db->order_by('descripcion_tip', 'asc');
  $tipos_cuenta = $this->db->get();

  if($tipos_cuenta->num_rows() > 0 ){
   return $tipos_cuenta->result();
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

public function insertar_usuario($data){

 $this->db->insert('usuarios', $data);

}

public function consultar_rut($rut_usu){

 $query = $this->db->query("SELECT rut_usu FROM usuarios WHERE rut_usu='$rut_usu'");
 $usuario = $query->row();

 if(empty($usuario)) {echo false;} //Si existe devolvemos false
 else {echo true; }//Si no existe, true.
}

public function consultar_correo($correo_usu){

 $query = $this->db->query("SELECT correo_usu FROM usuarios WHERE correo_usu='$correo_usu'");
 $correo = $query->row();

 if(empty($correo)) {echo false;} //Si existe devolvemos false
 else {echo true; }//Si no existe, true.
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

}//FIn del Model

?>
