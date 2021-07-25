<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Estudiantes extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
      
     $this->load->model('M_Login');
        $this->load->model('M_Usuarios');
        $this->load->model('M_Estudiantes');
        $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');
   /* if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','Usted no esta permitido en ver esta pagina de grupo');
      redirect('admin','refresh');
    }*/
  }
public function index($page = 'add-user')
  {
      $user = $this->session->userdata('s_usuario');

      if (empty($user)){

         $data['mensaje'] = '';
         $this->load->view('V_Login',$data);

        }
        
        else{ 
            
            $this->load->view('layouts/Header.php');
            $data['menu_barra'] = $this->M_Login->mostrar_menu();
            $this->load->view('layouts/Menu.php', $data);
            
            $data['tipos_cuenta'] = $this->M_Usuarios->tipos_cuenta();
            $data['sucursales'] = $this->M_Usuarios->sucursales();
            $data_est['users'] = $this->M_Estudiantes->list_estudiantes();
            $this->load->view('usuarios/add-user.php',$data);
            $this->load->view('usuarios/list_estudiante.php',$data_est);
            $this->load->view('layouts/Footer.php');
        }
  }
  
  public function create_estudiante()
		{
			                    
                        // Check login
			if(!$this->session->userdata('s_usuario')) {
				//redirect('admin/dashboard');
                                show_404();
			}
                   
			                       
                            
                        if($_POST['rut_estu']){
			    
                            $cedula=$this->M_Estudiantes->consultar_rut($this->input->post('rut_estu'));
                            $correo=$this->M_Estudiantes->consultar_correo($this->input->post('correo_estu'));
                            //var_dump($this->input->post('rut_estu'));
                            var_dump($this->consultar_correo());
                            
                            if($cedula){
			       $this->session->set_flashdata('flashError', 'Ya existe estudiante con esa identficacion...elija otra.');
			            
    			        
			        }else {
                                    if($correo){
                                     
                                     $this->session->set_flashdata('flashError', 'Ya existe email registrado...Elija otro email.');
                                        
                                    }else{
                                        
                                        $this->M_Estudiantes->create_estudiante();
                                   $this->session->set_flashdata('flashSuccess', 'Estudiante / PP.FF. creado con exito.'); 
                                    }
			           
                                                                     
			        }
			        
			          
			    
			    
			}else{
			    
			    $this->session->set_flashdata('flashError', 'Nombre del Estudiante NO valida.');
			    
			    
			    
			}

                            
                       
                            
		        redirect('C_Estudiantes', 'refresh');
				

				
			
		}
                
                public function actualiza_estudiante()
		{
			$id= $this->input->post('rut_estu');
                    
                    $this->M_Estudiantes->actualiza_estudiante($id);
			
			$this->session->set_flashdata('flashSuccess', 'Estudiante Actualizado con Exito.'); 
                                                              
                       
                            
		        redirect('C_Estudiantes', 'refresh');
			
                        
		}
                
      public function consultar_rut(){
        
        $rut_usu = $this->input->post('rut_estu');
        $this->M_Estudiantes->consultar_rut($rut_usu);
    }

    public function consultar_correo(){
        
        $correo_usu = $this->input->post('correo_estu');
        $this->M_Estudiantes->consultar_correo($correo_usu);
    }
  
    public function eliminar(){
        
        /*Inicia validacion del lado del servidor*/
	 if (empty($_POST['id_pais'])){
			$this->session->set_flashdata('flashError', 'Upss....');
		} else{   

		
		$this->M_Estudiantes->elimina_estudiante($this->input->post('id_pais'));
		
			
		} 
		
        $this->session->set_flashdata('flashSuccess', 'Estudiante Eliminado con Exito.');
        
         redirect('C_Estudiantes', 'refresh');
        
    }


    
    
  public function list_user($page = 'list_user')
  {
     if (!file_exists(APPPATH.'views/admin/users/'.$page.'.php')) {
		    show_404();
		   }
		   $data['title'] = ucfirst($page);
		   $this->load->view('admin/header-script');
		   $this->load->view('admin/header');
		   $this->load->view('admin/header-bottom');
		   $this->load->view('admin/users/'.$page, $data);
		   $this->load->view('admin/footer');
  }
  
  public function list_users($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'admin/users/';
			$config['total_rows'] = $this->db->count_all('usuario');
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'Ultimos Usuarios';

			$data['users'] = $this->Administrator_Model->get_users(FALSE, $config['per_page'], $offset);

			 	$this->load->view('admin/header-script');
		 	 	 $this->load->view('admin/header');
		  		 $this->load->view('admin/header-bottom');
		   		 $this->load->view('admin/users/list_user', $data);
		  		$this->load->view('admin/footer');
		}

		public function delete($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->delete($id,$table);       
			$this->session->set_flashdata('success', 'Datos Borrados con exito.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function enable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->enable($id,$table);       
			$this->session->set_flashdata('success', 'Desactivado.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function desable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->desable($id,$table);       
			$this->session->set_flashdata('success', 'Activado con exito.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		

		public function update_user_data($page = 'update-user')
		{
			if (!file_exists(APPPATH.'views/admin/users/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('admin/dashboard');
			}

			$data['title'] = 'Actualizar Usuario';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('admin/header-script');
		 	 	 $this->load->view('admin/header');
		  		 $this->load->view('admin/header-bottom');
		   		 $this->load->view('admin/users/'.$page, $data);
		  		 $this->load->view('admin/footer');
			}else{
				//Upload Image
				
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$id = $this->input->post('id');
					$data['img'] = $this->Administrator_Model->get_user($id);
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_user_data($post_image);

				//Set Message
				$this->session->set_flashdata('Felicidades', 'Usuario Actualizado con Exito.');
				redirect('admin/users');
			}
			
		}
                
              
		
  
/*public function add_user($page = 'users')
		{
			if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}

			$data['title'] = 'CREACION NUEVO USUARIO';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');
			//$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('correo', 'Correo', 'required|callback_check_email_exists');
			//$this->form_validation->set_rules('role_id', 'role_id', 'required');
			if($this->form_validation->run() === FALSE){
				 $this->load->view('admin/header-script');
		 	 	 $this->load->view('admin/header');
		  		 $this->load->view('admin/header-bottom');
		   		 $this->load->view('admin/users'.$page, $data);
		  		 $this->load->view('admin/footer');
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$password = sha1('Test@123');
				
				$this->Administrator_Model->add_user($post_image, $password);

				//Set Message
				$this->session->set_flashdata('success', 'Usuario creado con exito.');
				redirect('admin/Dashboard');
			}
			
		}

		// Check user name exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one.');

			if ($this->User_Model->check_username_exists($username)) {
				return true;
			}else{
				return false;
			}
		}


		// Check Email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

			if ($this->User_Model->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}

		public function users($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'admin/users/';
			$config['total_rows'] = $this->db->count_all('usuario');
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'Ultimos Usuarios';

			$data['users'] = $this->Administrator_Model->get_users(FALSE, $config['per_page'], $offset);

			 	$this->load->view('admin/header-script');
		 	 	 $this->load->view('admin/header');
		  		 $this->load->view('admin/header-bottom');
		   		 $this->load->view('admin/users', $data);
		  		$this->load->view('admin/footer');
		}

		public function delete($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->delete($id,$table);       
			$this->session->set_flashdata('success', 'Datos Borrados con exito.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function enable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->enable($id,$table);       
			$this->session->set_flashdata('success', 'Desabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function desable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->desable($id,$table);       
			$this->session->set_flashdata('success', 'Enabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		public function update_user($id = NULL)
		{
			$data['user'] = $this->Administrator_Model->get_user($id);
			
			if (empty($data['user'])) {
				show_404();
			}
			$data['title'] = 'Actualizar Usuario';

			$this->load->view('admin/header-script');
	 	 	 $this->load->view('admin/header');
	  		 $this->load->view('admin/header-bottom');
	   		 $this->load->view('admin/update-user', $data);
	  		$this->load->view('admin/footer');
		}

		public function update_user_data($page = 'update-user')
		{
			if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('admin/index');
			}

			$data['title'] = 'Actualizar Usuario';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('admin/header-script');
		 	 	 $this->load->view('admin/header');
		  		 $this->load->view('admin/header-bottom');
		   		 $this->load->view('admin/'.$page, $data);
		  		 $this->load->view('admin/footer');
			}else{
				//Upload Image
				
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$id = $this->input->post('id');
					$data['img'] = $this->Administrator_Model->get_user($id);
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_user_data($post_image);

				//Set Message
				$this->session->set_flashdata('Felicidades', 'Usuario Actualizado con Exito.');
				redirect('admin/users');
			}
			
		}*/
}