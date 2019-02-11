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

		if ($this->model_Login->LogOK($this->input->post('usuario'), $this->input->post('contrasena'))) {
			
			//crear sesiones

			$datos_categorias['categorias']= $this->model_productos->getCategorias();

			$this->load->view('plantilla', [
				'titulo' => 'Inicio de sesion',
				'menu'=>  $this->load->view('menu', $datos_categorias, true),
				'cuerpo' => $this->load->view('InicioSesion',[],true)
			 ]
		);

		} else {
			
			$datos_categorias['categorias']= $this->model_productos->getCategorias();

			$this->load->view('plantilla', [
				'titulo' => 'Inicio de sesion',
				'menu'=>  $this->load->view('menu', $datos_categorias, true),
				'cuerpo' => $this->load->view('InicioSesion',[],true)
			 ]
		);

		}
		

	}

}