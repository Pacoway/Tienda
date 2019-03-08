<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrarEstado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Grocery_CRUD');
	}

	 public function index(){
      $crud = new Grocery_CRUD();
      $crud->set_theme('datatables');
			$crud->set_table('pedido');
			$crud->set_subject('Pedidos');
			$crud->unset_clone();//Quita el botón de clonar
			$crud->columns('pedido_id','fecha','estado','usuario_id','nombre_usuario_pedido','apellidos_pedido','dni_pedido');
			$crud->edit_fields('estado');
   
		$datos=$crud->render();

        $this->load->view('Plantilla', [
			'titulo' => 'Administrar Estado',
			'cuerpo' => $this->load->view('AdministrarEstado',$datos,true)
 		]);
     }
		 

}