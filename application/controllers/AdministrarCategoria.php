<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrarCategoria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Grocery_CRUD');
	}

	 public function index(){
        $crud = new Grocery_CRUD();
        $crud->set_theme('datatables');
		$crud->set_table('categorias');
		$crud->set_subject('Categorias');
		$crud->unset_clone();//Quita el botón de clonar
		$crud->columns('nombre','descripcion','visible');
   
		$datos=$crud->render();

        $this->load->view('Plantilla', [
			'titulo' => 'Administrar categorias',
			'cuerpo' => $this->load->view('AdministrarCategorias',$datos,true)
 		]);
     }
     
}