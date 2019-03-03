<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index($desde=0)
	{
		$this->load->model('Model_productos');
		$this->load->library('pagination');       
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