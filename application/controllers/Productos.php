<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
    
    public function index($desde=0) {
        $this->load->library('pagination');
        $this->load->model('Model_productos');
        
        $config['base_url'] = base_url() . 'index.php/Productos/index/';    
        $config['total_rows'] = $this->Model_productos->numeroDestacados();     
        $config['per_page'] = '6';      
        $config['uri_segment'] = '3';
        
        $this->pagination->initialize($config);    
        $datos['h2Inicial'] = 'Productos destacados';
        $datos['productos'] = $this->Model_productos->productosDestacados($desde, $config['per_page']);
        $datos['pag']= $this->pagination->create_links();
        
     
        $this->load->view('Plantilla', [
            'titulo' => 'productos destacados',
            'cuerpo' => $this->load->view('ListaArticulos', $datos, true),
        ]);
    }

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

    public function verCarrito() {
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->library('cart');

        $datos['productosCarrito'] = $this->cart->contents();
    
        $this->load->view('Plantilla', [
            'titulo' => 'confirmar pedido',            
            'cuerpo' => $this->load->view('Carrito', $datos, true),]);
    }

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

    public function vaciarCarrito(){
        $this->load->library ( 'cart' );
        $this->cart->destroy();
       // $this->verCarrito();
    }
        
    public function eliminarProducto($rowid) { 
        $this->load->library('cart');
        $data  =  array ( 
        'rowid'  =>  $rowid, 
        'qty'    => 0,
        );
        $this->cart->update($data);
        $this->verCarrito();
    }

    //Administracion de articulos
    public function administrarProductos(){
        $this->load->model('Model_productos');
        $productos['productos']= $this->Model_productos->getProductos();
        $this->load->view('Plantilla', [
            'titulo' => 'Administrar Productos',
	    	'cuerpo' => $this->load->view('AdministrarProductos',$datos_vista, true)
 		]);
    }

    public function tramitarPedido(){
        $this->load->model('Model_productos'); //cargo el modelo
        $this->load->model('Model_Login');
        $this->load->library('cart');

        $cesta=$this->cart->contents();
        if($this->session->userdata('usuario_id')){
            $clienteID=$this->session->userdata('usuario_id');
            $datosCliente=$this->Model_Login->getUsuario($clienteID);  
              
            if($this->Model_productos->comprobarStockCarrito($cesta)==""){
                $this->Model_productos->creaPedido($datosCliente);//aqui me peta
                $pedidoID= $this->Model_productos->ultimoPedido($clienteID);//ultimoPedido($usuarioID)
                $this->Model_productos->registraPedido($cesta, $pedidoID);
                $this->Model_productos->modificaStockCarrito($cesta);
                
                $datos['pedido'] = $this->Model_productos->getPedido($pedidoID);
                $datos['lineas']=$this->Model_productos->getLineasPedido($pedidoID);
                $datos['totales'] = $this->Model_productos->totalCompra($cesta);
                $this->vaciarCarrito();//vaciar carrito
                $this->load->view('Plantilla', [
                    'titulo' => 'Pedido realizados',            
                    'cuerpo' => $this->load->view('DetallePedido', $datos, true),]);
                }
            else{
                $this->load->view('Plantilla', [
                    'titulo' => 'Pedido realizados',            
                    'cuerpo' => $this->load->view('ProblemasCompra', [], true),]);
                }
            }
                
        else{
            $this->load->view('Plantilla', [
            'titulo' => 'Pedido realizados',            
            'cuerpo' => $this->load->view('ProblemasCompra', [], true),]);
        }

      }
}