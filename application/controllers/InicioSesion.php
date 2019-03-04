<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioSesion extends CI_Controller {

	public function index(){
        $this->load->model('Model_productos');
        $datos_categorias['categorias']= $this->Model_productos->getCategorias();

		$this->load->view('Plantilla', [
			'titulo' => 'Inicio de sesion',
			'cuerpo' => $this->load->view('InicioSesion',[],true)
 		]
	);
	}

	public function LogIn($desde=0){
		$this->load->model('Model_productos');
		$this->load->model('Model_Login');
		$this->load->library('pagination'); 
		$config['base_url'] = base_url() . 'index.php/Inicio/index';
        $config['total_rows'] = $this->Model_productos->numeroDestacados();
        $config['per_page'] = '3';
        $config['uri_segment'] = '4';
        
        $this->pagination->initialize($config);
        $datos['productos'] = $this->Model_productos->productosDestacados($desde, $config['per_page']);
        $datos['pag']= $this->pagination->create_links();

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

		if ($this->Model_Login->LogOK($this->input->post('usuario'), $this->input->post('contrasena'))& $this->form_validation->run() == TRUE) {			

			$this->session->set_userdata('usuario_id', $this->Model_Login->getID($this->input->post('usuario')));
			$this->session->set_userdata('nombre', $this->Model_Login->getNombre($this->input->post('usuario')));
			$this->session->set_userdata('administrador', $this->Model_Login->getAdmin($this->input->post('usuario')));
			
			$datos_categorias['categorias']= $this->Model_productos->getCategorias();
			$this->load->view('Plantilla', [
				'titulo' => 'Inicio de sesion',
				'cuerpo' => $this->load->view('Inicio',$datos,true)
			 ]);

		} else {
			$errormsg= "";
			if ($this->form_validation->run() == TRUE) {
				$errormsg= "Error en usuario o contraseña";
			}
			$this->load->view('Plantilla', [
				'titulo' => 'Inicio de sesion',
				'cuerpo' => $this->load->view('InicioSesion',['error'=> $errormsg],true)
			 ]);
		}
	}

	public function LogOut($desde=0){
		$this->load->model('Model_productos');
		$this->load->library('pagination');       
		$this->session->unset_userdata('usuario_id');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('administrador');
        $config['base_url'] = base_url() . 'index.php/Inicio/index';
        $config['total_rows'] = $this->Model_productos->numeroDestacados();
        $config['per_page'] = '3';
        $config['uri_segment'] = '4';
        
        $this->pagination->initialize($config);
        $datos['productos'] = $this->Model_productos->productosDestacados($desde, $config['per_page']);
        $datos['pag']= $this->pagination->create_links();

		$this->load->view('Plantilla', [
			'titulo' => 'Inicio',
			'cuerpo' => $this->load->view('Inicio',$datos,true)
 		]
	);
	}
	

}