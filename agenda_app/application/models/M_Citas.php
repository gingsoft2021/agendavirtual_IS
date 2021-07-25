<?php

/**
* 
*/
class M_Citas extends CI_Model
{

   public $variable;
	
function __construct()
{
	parent::__construct();
}

    public function geteventos(){
     

     $rut_usu = $this->session->userdata('s_rut');

     $this->db->select('CONCAT(estudiantes.pnombre," ", estudiantes.apellido_pa," ", estudiantes.apellido_ma,", ",motivos_citas.descripcion_mot) As title ,citas.id_ci id, citas.fecha_ini start, citas.fecha_ter end, citas.id_mot mot, CONCAT(estudiantes.pnombre," ", estudiantes.apellido_pa," ", estudiantes.apellido_ma) as estudiante');
     $this->db->select('CONCAT(usuarios.pnombre," ", usuarios.apellido_pa," ", usuarios.apellido_ma) as jefe_c, estudiantes.rut_estu rut_estudiante');
     $this->db->from('citas');
     $this->db->join('estudiantes', 'citas.rut_estu = estudiantes.rut_estu');
     $this->db->join('motivos_citas','citas.id_mot = motivos_citas.id_mot');
     $this->db->join('usuarios','citas.rut_usu = usuarios.rut_usu');
     $this->db->where('usuarios.rut_usu', $rut_usu);

     return $this->db->get()->result();


    }

    public function  monday(){



    $rut_jc = $this->session->userdata('s_rut');


    $monday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.lunes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");


      if($monday->num_rows() > 0 ){
    
        return $monday->result();

        }
      
    }


    public function  tuesday(){



    $rut_jc = $this->session->userdata('s_rut');


    $tuesday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.martes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");


      if($tuesday->num_rows() > 0 ){
    
        return $tuesday->result();

        }
      
    }


    public function  wednesday(){



    $rut_jc = $this->session->userdata('s_rut');


    $wednesday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.miercoles='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");


      if($wednesday->num_rows() > 0 ){
    
        return $wednesday->result();

        }
      
    }


    public function  thursday(){



    $rut_jc = $this->session->userdata('s_rut');


    $thursday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.jueves='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");


      if($thursday->num_rows() > 0 ){
    
        return $thursday->result();

        }
      
    }

    public function  friday(){



    $rut_jc = $this->session->userdata('s_rut');


    $friday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.viernes='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");


      if($friday->num_rows() > 0 ){
    
        return $friday->result();

        }
      
    }

   
    public function  saturday(){



    $rut_jc = $this->session->userdata('s_rut');


    $saturday = $this->db->query("select * from (
SELECT MIN(horario.hrs_ini) AS hrs_ini, MAX(horario.hrs_ter) AS hrs_ter, id_hr, 
fecha_registro
FROM horario
INNER JOIN usuarios ON horario.rut_usu = usuarios.rut_usu
WHERE usuarios.rut_usu= '$rut_jc'
AND horario.sabado='ATTE. ESTUDIANTES' AND fecha_registro = (SELECT MAX(fecha_registro) FROM horario where rut_usu = '$rut_jc' ) ORDER BY id_hr DESC LIMIT 14
) tmp order by tmp.id_hr asc");

      if($saturday->num_rows() > 0 ){
    
        return $saturday->result();

        }
      
    }






  

}

?>