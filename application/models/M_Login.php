<?php


class M_Login extends CI_Model
{

	 public function ingresar($nombre_usu,$pass_usu){

          $this->db->select('usuarios.rut_usu,usuarios.nombre_usu,usuarios.pass_usu,usuarios.pnombre,usuarios.apellido_pa,usuarios.apellido_ma,usuarios.correo_usu, descripcion_tip, tipo_cuenta.id_tip,sucursales.nombre_suc, sucursales.id_suc, usuarios.estado');
          $this->db->from('usuarios');
          $this->db->join('tipo_cuenta','tipo_cuenta.id_tip = usuarios.id_tip');
          $this->db->join('sucursales','sucursales.id_suc = usuarios.id_suc');
          $this->db->where('nombre_usu',$nombre_usu);
          $this->db->where('pass_usu',$pass_usu);
          $this->db->where("estado='Activada'");


          $resultado = $this->db->get();



           if ($resultado->num_rows() ==  1) {

             $r = $resultado->row();

             $s_usuario =  array(
              's_rut' => $r->rut_usu,
              'estado' => $r->estado,
              'tipo' => $r->id_tip,
              'id_suc' => $r->id_suc,
              'cuenta' => $r->descripcion_tip,
              'sucursal' => $r->nombre_suc,
							'correo' => $r->correo_usu,
							'password' => $r->pass_usu,
              's_usuario' => $r->pnombre." ".$r->apellido_pa." ".$r->apellido_ma
              );

              $this->session->set_userdata($s_usuario);//esto es propio de codeigniter
               //$this->session->set_userdata('$_rut',$r->rut_per);
               //$this->session->set_userdata('$_nombre', $r->pnombre.",".$r->apellido_pa);

              return 1;

           }
           else
           {
              return 0;

           }

	 }


   public function mostrar_menu(){

   // $id_tip= $this->session->userdata('tipo');

    $this->db->select('id_mc, id_tip, id_man');
    $this->db->from('mantenedores_cuenta');
   // $this->db->where('id_tip',$id_tip);
    $menu = $this->db->get();

    $citas= "";
    $horarios ="";
    $informes="";
    $usuarios ="";
    $agenda ="";

    foreach ($menu->result() as $row) {

    if ($row->id_man == 1  ) {

   //$horarios .= "<li><a href='". base_url('index.php/C_Horarios') ."'>Administrar Horarios</a></li>";

    }

    if ($row->id_man == 2) {

    //$citas .="<li><a href=' ". base_url('index.php/C_Calendar') ."'>Agendar Citas</a></li>";

    }

    if ($row->id_man == 3) {
        $agenda .="<li><a href=' ". base_url('index.php/C_Calendar_Ad') ."'>Agendar Citas</a></li>";
    

    }

    if ($row->id_man == 4) {

    //$informes .= "<li><a href='" . base_url('index.php/C_Porcentaje') . "'>Porcentaje de Citas</a></li>";

    }


       if ($row->id_man == 7) {

    $usuarios.= "<li><a href='" . base_url('index.php/C_Administrar_Usuarios') . "'>Administrar Usuarios</a></li>";

    }

    if ($row->id_man == 6) {

    $usuarios.= "<li><a href='" . base_url('index.php/C_Usuarios') . "'>Registrar Usuarios</a></li>";

    }

    if ($row->id_man == 8) {

   // $horarios.= "<li><a href='" . base_url('index.php/C_Consultar_Horarios') . "'>Consultar Horarios</a></li>";
        $usuarios.= "<li><a href='" . base_url('index.php/C_Estudiantes') . "'>Registrar Estudiate</a></li>";
    }

    /*    if ($row->id_man == 9) {

    $informes .= "<li><a href='" . base_url('index.php/C_Porcentaje_Ad') . "'>Porcentaje de Citas</a></li>";
    }*/


    if ($row->id_man == 10) {

   $agenda .="<li><a href='". base_url('index.php/C_Citas') ." '></i>Consultar Citas</a></li>";



    }

    if ($row->id_man == 11) {

    //$horarios .="<li><a href='". base_url('index.php/app') ." '>Calendario</a></li>";

    }

        if ($row->id_man == 12) {

    //$informes .= "<li><a href='" . base_url('index.php/C_Consultar_Horarios_Ad') . "'>Consultar Horarios</a></li>";

    }




   } //Fin del Foreach

   $menu_barra="

	 <li>
		<a href='#'><i class='glyphicon glyphicon-user'></i> Usuarios<span class='fa arrow'></span></a>
		 <ul class='nav nav-second-level'>
                    $usuarios
		 </ul>
	 </li>

       <!-- <li>
				<a href='#'><i class='glyphicon glyphicon-calendar'></i> Horarios<span class='fa arrow'></span></a>
				<ul class='nav nav-second-level'>
                                $horarios
                               </ul>
        </li> -->

         <li>
				<a href='#'><i class='glyphicon glyphicon-calendar'></i> Agenda<span class='fa arrow'></span></a>
				<ul class='nav nav-second-level'>
                                $agenda
                               </ul>
        </li>
       <!-- <li>
        <a href='#'><i class='glyphicon glyphicon-education'></i> Informes<span class='fa arrow'></span></a>
        <ul class='nav nav-second-level'>
            $informes
          </ul>
        </li> -->
        


      ";

      return ($menu_barra);

 }//Fin de la function MEnu

}//Fin del Modelo

?>
