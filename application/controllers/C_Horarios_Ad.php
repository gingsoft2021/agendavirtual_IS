<?php

require_once APPPATH.'/third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;


class C_Horarios_Ad extends  CI_Controller{
	
	function __construct()
	{
		parent::__construct();
        
		$this->load->model('M_Login');
		 $this->load->database();
		$this->load->model('M_Horarios_Ad');
       
	}

	public function index(){
        
       $user = $this->session->userdata('s_usuario');

      if (empty($user)){

         $data['mensaje'] = '';
         $this->load->view('V_Login',$data);

        }

    else{  

		  $this->load->view('layouts/Header.php');
      $data['menu_barra'] = $this->M_Login->mostrar_menu();
      $this->load->view('layouts/Menu.php', $data);

      $this->load->model('M_Horarios');
      $data['tipo'] = $this->M_Horarios_Ad->get_tipos();
      $data['sucursales'] = $this->M_Horarios_Ad->sucursales();
      
      $data['table'] = $this->M_Horarios_Ad->mostrar_tabla();
      $this->load->view('usuarios/V_Administrar_Horarios_Ad.php',$data);
      $this->load->view('layouts/Footer.php');

    }

	}


	public function cargar_usuarios() {

        $id_tip = $this->input->post('id_tip');
        $id_suc = $this->input->post('id_suc');
        
        if($id_tip && $id_suc){

            $this->load->model('M_Horarios_Ad');
            $usuarios = $this->M_Horarios_Ad->get_usuario($id_tip, $id_suc);

            echo '<option value="0">--Seleccione un Usuario--</option>';

            foreach($usuarios as $fila){

                echo '<option value="'. $fila->rut.'">'. $fila->nom .' '. $fila->pat .' '.$fila->mat.'</option>';
            }

        }  

        else {

            echo '<option value="0">--Seleccione un Usuario--</option>';
        }
    }

    public function hacerAlgo() {

        $id_tip = $this->input->post('id_tip');
        $rut_usu = $this->input->post('rut_usu');

        
        echo 'id_tip= '. $id_tip. '; rut_usu = '. $rut_usu;
    }

    

   public function guardar_horario(){

    
    if (!empty($_FILES['file']['name'])) {
      
    
    $pathinfo = pathinfo($_FILES["file"]["name"]);
     
 
   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
           && $_FILES['file']['size'] > 0 ) {
         
        // Nombre Temporal del Archivo
        $inputFileName = $_FILES['file']['tmp_name']; 
    
        //Lee el Archivo usando ReaderFactory
        $reader = ReaderFactory::create(Type::XLSX);

        //var_dump($reader);
    
        $reader->setShouldFormatDates(true);

        // Abrimos el archivo
        $reader->open($inputFileName);
        $count = 1;
 
        //Numero de Hojas en el Archivo
        foreach ($reader->getSheetIterator() as $sheet) {
             
            // Numero de filas en el documento EXCEL
            foreach ($sheet->getRowIterator() as $row) {
 
                // Lee los Datos despues del encabezado
                // El encabezado se encuentra en la primera fila
             if($count > 1) {

                 
                $rut_usu = $this->input->post('rut_usu');
                $fecha_registro = $this->input->post('fecha_registro');
                $fecha_ini = $this->input->post('fecha_ini');
                $fecha_ter = $this->input->post('fecha_ter');
                

                $data = array(


                  'rut_usu' => $rut_usu,
                  'fecha_registro' => $fecha_registro,
                  'hrs_ini' => $row[0],
                  'hrs_ter' => $row[1],
                  'lunes' => $row[2],
                  'martes' => $row[3],
                  'miercoles' => $row[4],
                  'jueves' => $row[5],
                  'viernes' => $row[6],
                  'sabado' => $row[7],
                  'fecha_ini' => $fecha_ini,
                  'fecha_ter' => $fecha_ter

               ); 


                $this->db->insert('horario',$data);
    
             } 
                $count++;
            }
        }
 
        // cerramos el archivo EXCEL
        $reader->close();
 
    } else {
 
        echo "Seleccione un tipo de Archivo Valido";
    }
 
} else {
 
    echo "Seleccione un Archivo EXCEL";
     
}


   }






    }

?>