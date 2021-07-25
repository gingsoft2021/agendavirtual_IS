<?php

/**
* 
*/
class M_Perfiles extends CI_Model{

function __construct(){

	parent::__construct();
}


    public function mostrar_permisos(){
                
	  
	    $opciones="";
	    $n=0;

	    $this->db->select('id_man, nombre_man');
	    $this->db->from('mantenedores');
	    $resultado= $this->db->get();

	    foreach ($resultado->result() as $row) {

	    	$n++;
	    	$nombre_man=$row->nombre_man;
	    	$id_man=$row->id_man;
	    	$opciones.="	<div class='checkbox horizontal'>
			<label for='usuario'><input id='$n' class='permiso ' type='checkbox' value='$id_man'  >$nombre_man</label>
			</div>";
	    
	    }
         
        return ($opciones);

    }


   public function mantenedores(){
    
    $tabla="";
    $click="";
    $permisos="";
    $id_man="";
    $nombre_man="";
    $id_permisos="";
    $id_tip="";

   	$this->db->select('id_tip,descripcion_tip');
   	$this->db->from('tipo_cuenta');
   	$perfiles = $this->db->get();


   	foreach ($perfiles->result() as $row) {

   		$id_tip=$row->id_tip;
   		$descripcion_tip=$row->descripcion_tip;

   		$click.="$('.permiso').prop('checked', false);\n
        $('#descripcion_tip').val('$descripcion_tip');\n $('#id_tip').val('$id_tip');";

        $this->db->select('mantenedores.id_man, mantenedores.nombre_man');
        $this->db->from('mantenedores, tipo_cuenta, mantenedores_cuenta');
        $this->db->where('mantenedores_cuenta.id_tip = tipo_cuenta.id_tip');
        $this->db->where('mantenedores_cuenta.id_man = mantenedores.id_man');
        $this->db->where('mantenedores_cuenta.id_tip', $id_tip);
        $consulta = $this->db->get();

        foreach ($consulta->result() as $row) {


        	$id_man=$row->id_man;
        	$nombre_man=$row->nombre_man;
        	$permisos .="$nombre_man<br>";
        	$id_permisos="$id_man,";
        	$click.="$('#$id_man').prop('checked', true);\n";
        	
        }//Fin del Foreach

            $tabla.="  <tr>
            <td>$descripcion_tip</td>
            <td>$permisos</td>
            <td><button onclick=\"$click\" Mantenedores='$id_permisos' perfil='$id_tip' n_perfil='$descripcion_tip' class='btn btn-sm btn-default editar' >Editar <span class='glyphicon glyphicon-pencil'></span></button></td>
            </tr>";
            $permisos="";
            $id_permisos="";
            $click="";

   		
   	}//Fin del Foreach

    return ($tabla);

   }


   public function insertar_perfil($data){


   	$this->db->insert('tipo_cuenta', $data);

   }

   public function insertar_permisos($descripcion_tip, $id_man){

    $this->db->select('id_tip');
    $this->db->from('tipo_cuenta');
    $this->db->where('descripcion_tip', $descripcion_tip);
    $resultado= $this->db->get();

    $id_tip = " foreach ($resultado->result() as $row) { $row->id_tip; }";

    $this->db->insert('mantenedores_cuenta',' ',$id_tip, $id_man);







   }

  

  



}

?>