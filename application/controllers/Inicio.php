<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->view('plantilla', [
			'titulo' => 'Inicio',
			'menu' => $this->load->view('menu',[],true),
			'cuerpo' => $this->load->view('Inicio',[],true)
 		]
	);
	}

	public function mostrarCategorias(){
		$this->load->model('Model_productos');
		$this->load->view('plantilla', [
			'titulo' => 'Inicio',
			'menu' => $this->load->view('menu',[],true),
			'cuerpo' => $this->load->view('Inicio',[],true)
 		]
	);
	}
}