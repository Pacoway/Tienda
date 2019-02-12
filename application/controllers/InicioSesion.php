<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioSesion extends CI_Controller {

	public function index(){
        $this->load->model('model_productos');
        $datos_categorias['categorias']= $this->model_productos->getCategorias();

		$this->load->view('plantilla', [
			'titulo' => 'Inicio de sesion',
			'menu'=>  $this->load->view('menu', $datos_categorias, true),
			'cuerpo' => $this->load->view('InicioSesion',[],true)
 		]
	);
	}

	public function LogIn(){
		$this->load->model('model_productos');
		$this->load->model('model_Login');

		//añadir aqui set rules de form validation

		if ($this->model_Login->LogOK($this->input->post('usuario'), $this->input->post('contrasena'))& $this->form_validation->run() == TRUE) {			

			$this->session->set_userdata('usuario_id', $this->model_Login->getID($this->input->post('usuario')));
			$this->session->set_userdata('nombre', $this->model_Login->getNombre($this->input->post('usuario')));
			$this->session->set_userdata('administrador', $this->model_Login->getAdmin($this->input->post('usuario')));
			
			$datos_categorias['categorias']= $this->model_productos->getCategorias();
			$this->load->view('plantilla', [
				'titulo' => 'Inicio de sesion',
				'menu'=>  $this->load->view('menu', $datos_categorias, true),
				'cuerpo' => $this->load->view('Inicio',[],true)
			 ]);

		} else {
			
			$datos_categorias['categorias']= $this->model_productos->getCategorias();
			$this->load->view('plantilla', [
				'titulo' => 'Inicio de sesion',
				'menu'=>  $this->load->view('menu', $datos_categorias, true),
				'cuerpo' => $this->load->view('InicioSesion',[],true)
			 ]);
		}
		

	}

	public function LogOut(){
		$this->load->model('model_productos');
		$this->session->unset_userdata('usuario_id');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('administrador');

		$this->load->view('plantilla', [
			'titulo' => 'Inicio de sesion',
			'menu'=>  $this->load->view('menu', $datos_categorias, true),
			'cuerpo' => $this->load->view('Inicio',[],true)
		 ]);
	}

}