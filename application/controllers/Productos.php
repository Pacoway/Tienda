<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {


    public function index(){
        $this->load->model('model_productos');
        $datos_vista['productos']= $this->model_productos-> productosDestacados();
        $datos_categorias['categorias']= $this->model_productos-> getCategorias();

       //cargo la vista pasando los datos de configuacion
        $this->load->view('plantilla', [
        'titulo'=>'productos',
        'menu'=>  $this->load->view('menu', $datos_categorias, true),
        'cuerpo'=>$this->load->view('listado_articulos',  $datos_vista, true),
        ]);
    }

    public function mostrarCategorias($id_categoria){
        $this->load->model('model_productos');
        $datos_categorias['categorias']= $this->model_productos-> getCategorias();
        $datos_vista['productos']= $this->model_productos->getProductosPorCategoria($id_categoria);
		$this->load->view('plantilla', [
			'titulo' => 'Inicio',
			'menu'=>  $this->load->view('menu', $datos_categorias, true),
			'cuerpo' => $this->load->view('ListaArticulos',$datos_vista, true)
 		]
	);
	}
    
}