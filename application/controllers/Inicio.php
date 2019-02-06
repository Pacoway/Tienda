<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
        $this->load->model('model_productos');
        $datos_categorias['categorias']= $this->model_productos->getCategorias();

		$this->load->view('plantilla', [
			'titulo' => 'Inicio',
			'menu'=>  $this->load->view('menu', $datos_categorias, true),
			'cuerpo' => $this->load->view('Inicio',[],true)
 		]
	);
	}

}