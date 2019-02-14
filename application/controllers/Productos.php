<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {


    public function index(){
        $this->load->model('model_productos');
        $datos_vista['productos']= $this->model_productos-> productosDestacados();
     
       //cargo la vista pasando los datos de configuacion
        $this->load->view('plantilla', [
        'titulo'=>'productos',
         'cuerpo'=>$this->load->view('listado_articulos',  $datos_vista, true),
        ]);
    }

    public function mostrarCategorias($id_categoria){
        $this->load->model('model_productos');
        $datos_vista['productos']= $this->model_productos->getProductosPorCategoria($id_categoria);
        
        $this->load->view('plantilla', [
            'titulo' => 'Categorias',
	    	'cuerpo' => $this->load->view('ListaArticulos',$datos_vista, true)
 		]);
	}
    
    public function mostrarDetalles($prodId){
        $this->load->model('model_productos');//cargo el modelo
        
        $datos_vista['productos']= $this->model_productos-> getProducto($prodId);
        $datos_menu['categorias']= $this->model_productos-> getCategorias();
        $datos_titulo['titulo']= $this->model_productos->productoNombre($prodId);
 
        $this->load->view('Plantilla', [
            'titulo' => $datos_titulo['titulo'],
            'menu'=>  $this->load->view('menu', $datos_menu, true),
            'cuerpo'=>$this->load->view('detalleProducto',  $datos_vista, true),
        ]
    );
    }

    public function verCarrito() {
        $this->load->model('model_productos'); //cargo el modelo
        $this->load->library('cart');

        $datos['productosCarrito'] = $this->cart->contents();
    
        $this->load->view('plantilla', [
            'titulo' => 'confirmar pedido',            
            'cuerpo' => $this->load->view('Carrito', $datos, true),]);
    }

    public function addProducto($id) {
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->library ( 'cart' );
        //$this->cart->destroy();
        $cantidad = 1;//$this->input->post('cantidad');
        $producto = $this->Model_productos->getProducto($id);   
        $data = array(//cogemos los productos en un array para insertarlos en el carrito
            'id' => $id,
            'descuento' => $producto->descuento,
            'imagen' => $producto->imagen,
            'qty' => $cantidad, //la cantidad que se está comprando
            'price' => $producto->precio,
            'name' => $producto->nombre); 
        
        $this->cart->insert($data); //introduzco el articulo en el carrito
        $this->verCarrito();

        /*  foreach($datos['productosCarrito'] as &$producto) {
            $producto_bd = $this->model_productos->getProducto($producto['id']);
            $producto_bd['imagen']=$producto->imagen;
        }*/
     
    }

    public function vaciarCarrito(){
        $this->load->library ( 'cart' );
        $this->cart->destroy();
        $this->verCarrito();
    }

}