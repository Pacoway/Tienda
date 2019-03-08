<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
    
    /**
     * Muestra de articulso destacados con pagiancion
     */
    public function index($desde=0) {
        $this->load->library('pagination');
        $this->load->model('Model_productos');
        
        $config['base_url'] = base_url() . 'index.php/Productos/index/';    
        $config['total_rows'] = $this->Model_productos->numeroDestacados();     
        $config['per_page'] = '6';      
        $config['uri_segment'] = '3';
        
        $this->pagination->initialize($config);    
        $datos['productos'] = $this->Model_productos->productosDestacados($desde, $config['per_page']);
        $datos['pag']= $this->pagination->create_links();
        
     
        $this->load->view('Plantilla', [
            'titulo' => 'productos destacados',
            'cuerpo' => $this->load->view('ListaArticulos', $datos, true),
        ]);
    }

    /**
     * Muestra articulos de la categoria con paginacion
     */
    public function mostrarCategorias($catId, $desde=0) {
  
        $this->load->model('Model_productos');
        $this->load->library('pagination');       
        $config['base_url'] = base_url() . 'index.php/Productos/mostrarCategorias/'.$catId;
        $config['total_rows'] = $this->Model_productos->numeroProductosPorCategoria($catId);
        $config['per_page'] = '3';
        $config['uri_segment'] = '4';
        
        $this->pagination->initialize($config);
        $datos['titulo'] = $this->Model_productos->categoriaNombre($catId);
        $datos['h2Inicial'] = $this->Model_productos->descripcionCategoria($catId);
        $datos['productos'] = $this->Model_productos->getProductosPorCategoriaPaginados($catId, $desde, $config['per_page']);
        $datos['pag']= $this->pagination->create_links();
        
        $this->load->view('Plantilla', [
            'titulo' => $datos['titulo'],
            'cuerpo' => $this->load->view('ListaArticulos', $datos, true),
        ]);
    }
    
/**
 * Detalles de un producto en especifico
 */
    public function mostrarDetalles($prodId){
        $this->load->model('Model_productos');//cargo el modelo
        
        $datos_vista['productos']= $this->Model_productos->getProducto($prodId);
        $datos_titulo['titulo']= $this->Model_productos->productoNombre($prodId);
 
        $this->load->view('Plantilla', [
            'titulo' => $datos_titulo['titulo'],
            'cuerpo'=>$this->load->view('detalleProducto',  $datos_vista, true),
        ]
    );
    }

    /**
     * Ver carrito de la compra
     */
    public function verCarrito() {
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->library('cart');

        $datos['productosCarrito'] = $this->cart->contents();
    
        $this->load->view('Plantilla', [
            'titulo' => 'confirmar pedido',            
            'cuerpo' => $this->load->view('Carrito', $datos, true),]);
    }

    /**
     * Añadir producto al carrito
     */
    public function addProducto($id, $mult=FALSE) {
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->library('cart');
        if ($mult) {
            $cantidad = $this->input->post('cantidad');
        } else {
            $cantidad = 1;
        }
        
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
     
    }

    /**
     * Vaciado de carrito
     */
    public function vaciarCarrito(){
        $this->load->library ( 'cart' );
        $this->cart->destroy();
    }

    public function vaciarCarrito2(){
        $this->load->library ( 'cart' );
        $this->cart->destroy();
        $this->verCarrito();
    }
      
    /**
     * Borrar 1 producto del carrito
     */
    public function eliminarProducto($rowid) { 
        $this->load->library('cart');
        $data  =  array ( 
        'rowid'  =>  $rowid, 
        'qty'    => 0,
        );
        $this->cart->update($data);
        $this->verCarrito();
    }

    /**
     * Administracion de articulos
     */
    public function administrarProductos(){
        $this->load->model('Model_productos');
        $productos['productos']= $this->Model_productos->getProductos();
        $this->load->view('Plantilla', [
            'titulo' => 'Administrar Productos',
	    	'cuerpo' => $this->load->view('AdministrarProductos',$datos_vista, true)
 		]);
    }

    /**
     * Genera el pedido con sus lineas de pedidos correspondientes
     */
    public function tramitarPedido(){
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->model('Model_Login');
        $this->load->library('cart');

        $cesta=$this->cart->contents();
        if($this->session->userdata('usuario_id')){
            $clienteID=$this->session->userdata('usuario_id');
            $datosCliente=$this->Model_Login->getUsuario($clienteID);  
              
            if($this->Model_productos->comprobarStockCarrito($cesta)==""){
                $this->Model_productos->creaPedido($datosCliente);
                $pedidoID= $this->Model_productos->ultimoPedido($clienteID);
                $this->Model_productos->registraPedido($cesta, $pedidoID);
                $this->Model_productos->modificaStockCarrito($cesta);
                
                $datos['pedido'] = $this->Model_productos->getPedido($pedidoID);
                $datos['lineas']=$this->Model_productos->getLineasPedido($pedidoID);
                $datos['totales'] = $this->Model_productos->totalCompra($cesta);
                $this->vaciarCarrito();
                $this->load->view('Plantilla', [
                    'titulo' => 'Pedido realizados',            
                    'cuerpo' => $this->load->view('DetallePedido', $datos, true),]);
                }
            else{
                $datos['mensaje'] ="Producto fuera de stock";
                $this->load->view('Plantilla', [
                    'titulo' => 'Pedido realizados',            
                    'cuerpo' => $this->load->view('ProblemasCompra', $datos, true),]);
                }
            }
                
        else{
            $datos['mensaje'] ="Es encesario logearse para comprar con el carrito";
            $this->load->view('Plantilla', [
            'titulo' => 'Pedido realizados',            
            'cuerpo' => $this->load->view('ProblemasCompra', $datos, true),]);
        }

      }

      /**
       * Ver lista de pedidos
       */
      public function verPedidos(){
        $this->load->model('Model_productos');
        $datos['pedidos'] = $this->Model_productos->getPedidosJoin($this->session->userdata('usuario_id'));
        $this->load->view('Plantilla', [
            'titulo' => 'Pedidos',            
            'cuerpo' => $this->load->view('VerPedidos', $datos, true),]);
          
      }

      /**
       * Ver lista de linea de pedidos
       */
      public function verListaPedido($pedido_id){
        $this->load->model('Model_productos');
        $datos['numeroPedido']= $pedido_id;
        $datos['pedidos'] = $this->Model_productos->getListaPedidos($pedido_id);
        $this->load->view('Plantilla', [
            'titulo' => 'Pedidos',            
            'cuerpo' => $this->load->view('VerListaPedido', $datos, true),]);
          
      }
}