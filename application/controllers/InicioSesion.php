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

	public function LogIn(){
		$this->load->model('Model_productos');
		$this->load->model('Model_Login');

		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

		if ($this->Model_Login->LogOK($this->input->post('usuario'), $this->input->post('contrasena'))& $this->form_validation->run() == TRUE) {			

			$this->session->set_userdata('usuario_id', $this->Model_Login->getID($this->input->post('usuario')));
			$this->session->set_userdata('nombre', $this->Model_Login->getNombre($this->input->post('usuario')));
			$this->session->set_userdata('administrador', $this->Model_Login->getAdmin($this->input->post('usuario')));
			
			$datos_categorias['categorias']= $this->Model_productos->getCategorias();
			$this->load->view('plantilla', [
				'titulo' => 'Inicio de sesion',
				'cuerpo' => $this->load->view('Inicio',[],true)
			 ]);

		} else {
			$errormsg= "";
			if ($this->form_validation->run() == TRUE) {
				$errormsg= "Error en usuario o contraseña";
			}
			$datos_categorias['categorias']= $this->model_productos->getCategorias();
			$this->load->view('Plantilla', [
				'titulo' => 'Inicio de sesion',
				'cuerpo' => $this->load->view('InicioSesion',['error'=> $errormsg],true)
			 ]);
		}
		

	}

	public function LogOut(){
		$this->load->model('Model_productos');
		$this->session->unset_userdata('usuario_id');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('administrador');

        $datos_categorias['categorias']= $this->Model_productos->getCategorias();
		$this->load->view('Plantilla', [
			'titulo' => 'Inicio de sesion',
			'cuerpo' => $this->load->view('Inicio',[],true)
		 ]);
	}

}