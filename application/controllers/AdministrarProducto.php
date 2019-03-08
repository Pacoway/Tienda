<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrarProducto extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Grocery_CRUD');
	}

	 public function index(){
      $crud = new Grocery_CRUD();
      $crud->set_theme('datatables');
			$crud->set_table('producto');
			$crud->set_subject('Productos');
			$crud->unset_clone();//Quita el botón de clonar
			$crud->columns('nombre','precio','descuento','imagen','iva','descripcion','anuncio','stock','categoria_id','visible','destacado');
   
		$datos=$crud->render();

        $this->load->view('Plantilla', [
			'titulo' => 'Administrar Productos',
			'cuerpo' => $this->load->view('AdministrarProductos',$datos,true)
 		]);
     }
		 

}