<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
        $this->load->model('Model_productos');
        $datos_categorias['categorias']= $this->Model_productos->getCategorias();

		$this->load->view('Plantilla', [
			'titulo' => 'Inicio',
			'cuerpo' => $this->load->view('Inicio',[],true)
 		]
	);
	}

}