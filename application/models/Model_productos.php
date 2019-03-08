<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_productos extends CI_Model {

    public function __construct() { // son 2 barras bajas _ _ juntitas
        $this->load->database();
    }

    /**
     * Devuelve los productos
     */
    public function getProductos() {

        $productos = $this->db->get('producto');
        return $productos;
    }

    /**
     * Devuelve los productos detacados con paginacion
     */
    public function productosDestacados($desde, $por_pagina) { 
        $query = ("select * from producto where destacado=1 and visible=1 LIMIT $desde,$por_pagina");
        $prodes = $this->db->query($query);
        return $prodes->result(); 
    }

  /**
   * Devuelve la cantidad de destacados
   */
    public function numeroDestacados(){
            $query = "select * from producto where destacado=1 and visible=1";
            $npro  = $this->db->query($query);
            return $npro->num_rows();
    }

    public function getProductosPorCategoriaPaginados($catId, $desde, $por_pagina) {

        $query = $this->db->query("select * from producto where categoria_id='$catId' and visible=1 LIMIT $desde,$por_pagina");
        $productos = $query->result();
        return $productos;
    }
    
    public function numeroProductosPorCategoria($catId) {

        $query = ("select * from producto where categoria_id='$catId' and visible=1");
        $numProductos = $this->db->query($query);
        return $numProductos->num_rows();
    }


    /**
     * Devuelve el producto por id
     */
    public function getProducto($prodId) {
        $rs = $this->db
        ->from('producto')
        ->where('producto_id', $prodId)
        ->get();

        return $rs->row();
    }
    


    public function descripcionProducto($prodId){
        $rs = $this->db
            ->select('descripcion')
            ->from('producto')
            ->where('producto_id', $prodId)
            ->get();

        $reg= $rs->row();
        if ($reg) {
            return $reg->descripcion;
        }
        else {
            return '';
        }
    }

    public function productoNombre($prodId){
        $rs = $this->db
            ->select('nombre')
            ->from('producto')
            ->where('producto_id', $prodId)
            ->get();
    
        $reg= $rs->row();
        if ($reg) {
            return $reg->nombre;
        }
        else {
            return '';
        }
         
    }

   /**
     * Saca los nombres de todas las categorias
     * @return type
     * visible=1 --> visible ok
     * visible =0 --> no visible 
     */
    public function getCategorias() {
        $rs = $this->db
        ->from('categorias')
        ->where('visible', 1)
        ->get();
        return $rs->result();
    }

//saca productos por categorias
    public function getProductosPorCategoria($catId) {
     
        $rs = $this->db
        ->from('producto')
        ->where('categoria_id', $catId)
        ->where('visible', 1)
        ->get();

        return $rs->result();
    }
    public function categoriaNombre($id){
        $rs = $this->db
        ->select('nombre')
        ->from('categorias')
        ->where('categoria_id', $id)
        ->get();

        $reg= $rs->row();
        if ($reg) {
            return $reg->nombre;
        }
        else {
            return '';
        }
    }

   /**
    * Función que me devuelva la descripción del contenido de una categoria
    * 
    */
    public function descripcionCategoria($id){
        $this->db->where('categoria_id',$id);
        $consulta=$this->db->get('categorias');
        return $consulta;
    }    


    public function insertCategoria($id, $nombre, $descripcion, $anuncio, $visible) {
        $datos = array(
            'categoria_id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'anuncio' => $anuncio,
            'visible' => $visible
        );
        $this->db->insert('categoria', $datos);
    }

    public function comprobarStock($idArti, $canti){
        $rs = $this->db 
                ->select('stock')
                ->from('producto')
                ->where('producto_id', $idArti)
                ->get();
        $reg = $rs->row();
        if ($reg) { 
            if($reg->stock>$canti){
                return true;
            }else{
                return false;
            }
        } else { 
            return '';
        }
        
    }

    /**
     * Comprobar el stock de todo el carrito e informar del problema
     */
    public function comprobarStockCarrito($carrito){
        $mensaje="";
        foreach ($carrito as $producto) {
            if(!$this->comprobarStock($producto['id'],$producto['qty'])){
                $mensaje .= "no hay Stock suficiente del producto ".$producto['name']."<br>";
            }else{
                $mensaje .= "";
            }
        }
        return $mensaje;

    }
    /**
     * Nos devuelve todos los pedidos realizados por el usuario_id
     */
    public function getPedidos($id) {
        $query = "select * from pedido where usuario_id=" . $id . "";
        $query = $this->db->query($query);
        return $query->result();
    }

    public function getPedidosJoin($id) {
        $query = "SELECT pedido.* , linea_pedido.importe FROM pedido INNER JOIN linea_pedido ON linea_pedido.pedido_id = pedido.pedido_id WHERE pedido.usuario_id =".$id;
        $query = $this->db->query($query);
        return $query->result();
    }

    public function getListaPedidos($id) {
        $rs = $this->db //rs=resultado
        ->from('linea_pedido')
        ->where('pedido_id', $id)
        ->get();
        return $rs->result();
    }

    /**
     * devuelve el id del ultimo pedido 
     */
    public function ultimoPedido($usuarioID){
        $query="SELECT MAX(pedido_id) AS pedido_id FROM pedido WHERE usuario_id=$usuarioID ";
        $query = $this->db->query($query);
        return $query->row()->pedido_id;

    }

    /**
     * devuelve la imagen
     */
    public function productoImg($prodId){
        $rs = $this->db
            ->select('imagen')
            ->from('producto')
            ->where('producto_id', $prodId)
            ->get();
    
        $reg= $rs->row();
        if ($reg) {
            return $reg->imagen;
        }
        else {
            return '';
        }
         
    }

    public function aplicaDescuento($id){
        $rs = $this->db 
                
                ->from('producto')
                ->where('producto_id', $id)
                ->get();       
        $reg= $rs->row(); 
        if ($reg) { 
            $porcentajeDescuento=$reg->descuento/100;
            $precioFin= $reg->precio - ($reg->precio*$porcentajeDescuento);
            return $precioFin;
        }
        else {
            return '';
        }
    }


    public function subTotal($precioConDescuento, $cantidad){
        return $precioConDescuento * $cantidad;
    }


/**
 * Registro de pedido
 */
    public function registraPedido($productosCarrito, $pedido_id){

        foreach ($productosCarrito as $producto) {
            $imagen=$this->productoImg($producto['id']);
            $nombre=$this->productoNombre($producto['id']);
            $precioConDescuento= $this->aplicaDescuento($producto['id']);           
            $subT= $this->subTotal($precioConDescuento, $producto['qty']);
        
            $linea= array(
                'producto_id'=>$producto['id'],
                'cantidad'=>$producto['qty'],
                'importe'=>$subT,
                'nombre_producto'=>$nombre,
                'imagen_producto'=>$imagen,
                'pedido_id'=>$pedido_id
            );
          $this->db->insert('linea_pedido', $linea); 
        }
    }

    /**
     * Nos devuelve todas las lineas de pedido pertenecientes a una misma compra
     */
    public function getLineasPedido($idPedido){
        $query = "select * from linea_pedido where pedido_id=" . $idPedido . "";
        $query = $this->db->query($query);
        return $query->result();
    }

    public function getStock($id){
        $rs = $this->db
        ->select('stock')
        ->from('producto')
        ->where('producto_id', $id)
        ->get();

        $reg= $rs->row();
        if ($reg) {
            return $reg->stock;
        }
        else {
            return '';
        }
    }

    
     /**
      * Modifica el estock del producto en función de la cantidad vendida del articulo
      */
    public function ventaProducto($idProducto, $cantidad, $stockPrevioVenta){
        $nuevoStock= $stockPrevioVenta- $cantidad ;
        $data = array(
            'producto_id' => $idProducto,
            'stock' => $nuevoStock);
    
        $this->db->where('producto_id', $idProducto);
        $this->db->update('producto', $data);
    }

    public function modificaStockCarrito($cesta){
        foreach ($cesta as $producto) {
            $stockPrevio=$this->getStock($producto['id']);
            $this->ventaProducto($producto['id'],$producto['qty'],$stockPrevio);   
        }

    }
 

    /**
     * devuelve el stock del producto al anularlo
     */
    public function devolucionProducto($productoID, $cantidadDevuelta, $stockPostVenta){
        $nuevoStock= $cantidadDevuelta + $stockPostVenta;
        $data = array(
            'producto_id' => $productoID,
            'stock' => $nuevoStock);
    
        $this->db->where('producto_id', $productoID);
        $this->db->update('producto', $data);
    }

    /**
     * Cambia el estado del pedido
     */
    public function cambiaEstadoPedido($idPedido, $nuevoEstado){
        $data = array(
            'estado' => $nuevoEstado);    
        $this->db->where('pedido_id', $idPedido);
        $this->db->update('producto', $data);

    }
    /**
     * Cambia las siglas de estado por palabra
     */
    public function aclaraEstado($estado){
        switch (strtoupper($estado))
        {
            case 'C':
                return 'Cancelado';
                break;
            case 'P':
                return 'Pendiente';
                break;
            case 'E':
                return 'Enviado';
                break;
            case 'R':
                return 'Recibido';
                break;
        }
    }

    public function getEstadoPedido($idPedido){
        $rs = $this->db 
        ->select('estado')
        ->from('pedido')
        ->where('$pedido_id', $idPedido)
        ->get();
        $reg = $rs->row();
        if ($reg) {
            $reg->estado;
        } else { 
            return '';
        }
    }
    /**
     * Obtener los datos de un pedido
     */
    public function getPedido($id){
        $rs = $this->db
        ->from('pedido')
        ->where('pedido_id', $id)
        ->get();
        $reg = $rs->row(); 
        if ($reg) { 
            return $reg;
        } else { 
            return '';
        }
      }

      public function ivaProductoSubTotal($id, $subTotal) {
        $rs = $this->db
                ->select('iva')
                ->from('producto')
                ->where('producto_id', $id)
                ->get();
        $reg = $rs->row(); 
        if ($reg) { 

            $divisor= 1+($reg->iva/100);
            $baseImponible = round(($subTotal / $divisor), 2,PHP_ROUND_HALF_DOWN) ;
            return ($subTotal - $baseImponible) ;
        } else { 
            return '';
        }
    }

      public function totalCompra($productosCarrito) {
        $info=[];
        $sumaCompra=0;
        $sumaIVA=0;
        foreach ($productosCarrito as $producto) {
            $precioConDescuento= $this->aplicaDescuento($producto['id']);
            $subT= $this->subTotal($precioConDescuento, $producto['qty']);
            $subTIVA= $this->ivaProductoSubTotal($producto['id'], $subT);
            $sumaCompra += $subT;
            $sumaIVA += $subTIVA;

        }
        return $info=array('aPagar'=>$sumaCompra, 'desgloseIVA'=>$sumaIVA);
    }

      public function creaPedido($datosCliente){
          $datos="";
              $datos=array(                 
                  'usuario_id' => $datosCliente->usuario_id,
                  'nombre_usuario_pedido' => $datosCliente->nombre,
                  'apellidos_pedido' => $datosCliente->apellidos,
                  'dni_pedido' => $datosCliente->dni
                );
          $this->db->insert('pedido', $datos);        
      }



}