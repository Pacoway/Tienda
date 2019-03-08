<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Muestra La pagina principal de la tienda
 */
class Inicio extends CI_Controller {

	public function index($desde=0)
	{
		$this->load->library('pagination');       
		$this->load->model('Model_productos');
        $config['base_url'] = base_url() . 'index.php/Inicio/index';
        $config['total_rows'] = $this->Model_productos->numeroDestacados();
        $config['per_page'] = '6';
        $config['uri_segment'] = '3';
        
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