<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_productos extends CI_Model {

    public function __construct() { // son 2 barras bajas _ _ juntitas
        $this->load->database();
    }

    public function getProductos() {

        $productos = $this->db->get('producto');
        return $productos;
    }
    /**
     * Devuelve los productos detacados siempre y cuando las fechas coincidan
     * @return type
     */
   
   /*  public function productosDestacados() //importate PAGINAR
    {//$desde, $por_pagina pendientes de pasar por parametros a la función para cuando pagine
     // $query  = ("select * from producto where destacado=1 and visible=1 and finicio_dest<=CURDATE() and ffin_dest>=CURDATE() LIMIT $desde,$por_pagina");
        $rs = $this->db
        ->from('producto')
        ->where('destacado', 1)
        ->where('visible', 1)
        ->get();
        return $rs->result();//No usar result array, si en la vista quiero usar un foreach normalito
        //return $prodes->result_array();
    }*/

    public function productosDestacados($desde, $por_pagina) { 
        // $query  = ("select * from producto where destacado=1 and visible=1 and finicio_dest<=CURDATE() and ffin_dest>=CURDATE() LIMIT $desde,$por_pagina");
        $query = ("select * from producto where destacado=1 and visible=1 LIMIT $desde,$por_pagina");

        $prodes = $this->db->query($query);
        return $prodes->result(); 
        //return $prodes->result_array();
    }

  
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

//
    /**
     * Devuelve toda la información de un producto dado su ID
     * @param type $prodId
     * @return type
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

//crea una nueva categoria
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
        $rs = $this->db //rs=resultado
                ->select('stock')
                ->from('producto')
                ->where('producto_id', $idArti)
                ->get();
        $reg = $rs->row(); //reg = registro de resultado
        if ($reg) { //en el caso de obtener dato a la consulta
            if($reg->stock>$canti){
                return true;
            }else{
                return false;
            }
        } else { //en el caso de no obtener ningun resultado a la consulta
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
                $mensaje .= "";//si está vacio es que hay stock suficiente de todo lo que ha seleccionado
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

    public function ultimoPedido($usuarioID){
        //SELECT MAX(pedido_id) AS pedido_id FROM pedido WHERE usuario_id=12
        $query="SELECT MAX(pedido_id) AS pedido_id FROM pedido WHERE usuario_id=$usuarioID ";
        $query = $this->db->query($query);
       // return $query->result();
        return $query->row()->pedido_id;

    }

    /**
     * Por cada articulo del carrito creo una linea de pedido
     * así almaceno toda la información relativa a la compra
     */
  /*  public function guardarLineaPedido($datos){

          $this->db->insert('linea_pedido', $datos); 
    }*/


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

    public function aplicaDescuento($id){ //no funciona
        $rs = $this->db //rs=resultado
                
                ->from('producto')
                ->where('producto_id', $id)
                ->get();       
        $reg= $rs->row(); //reg = registro de resultado
        if ($reg) { //en el caso de obtener dato a la consulta
            $porcentajeDescuento=$reg->descuento/100;
            $precioFin= $reg->precio - ($reg->precio*$porcentajeDescuento);
            return $precioFin;
        }
        else { //en el caso de no obtener ningun resultado a la consulta
            return '';
        }
    }


    public function subTotal($precioConDescuento, $cantidad){
        return $precioConDescuento * $cantidad;
    }


/**
 * Por cada una de las lineas de pedido de un usuario en la misma fecha
 * vamos insertado campos en el pedido
 */
    public function registraPedido($productosCarrito, $pedido_id){

       // print_r($pedido_id);
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
         // $this->guardarLineaPedido($linea);
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
            $this->ventaProducto($producto['id'],$producto['qty'],$stockPrevio);            # code...
        }

    }
 

    /**
     * Tras la anulación del un pedido pendiente 
     * de procesar, los articulos no se han logrado 
     * vender, por lo tanto hay que restaurar el stock
     * a la situación inicial
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
     * Estado Inicial: PENDIENTE de procesar  (este estado se puede ANULAR)
     * Cuando se ha enviado: PROCESADO
     * Se ha realizado la entrega del pedido: RECIBIDO
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
        $rs = $this->db //rs=resultado
        ->select('estado')
        ->from('pedido')
        ->where('$pedido_id', $idPedido)
        ->get();
        $reg = $rs->row(); //reg = registro de resultado
        if ($reg) { //en el caso de obtener dato a la consulta
            $reg->estado;
        } else { //en el caso de no obtener ningun resultado a la consulta
            return '';
        }
    }
    /**
     * Obtener los datos de un pedido
     * @param String $id ID de usuario
     */
    public function getPedido($id){
        $rs = $this->db
        ->from('pedido')
        ->where('pedido_id', $id)
        ->get();
        $reg = $rs->row(); //reg = registro de resultado
        if ($reg) { //en el caso de obtener dato a la consulta
            return $reg;
        } else { //en el caso de no obtener ningun resultado a la consulta
            return '';
        }
      }

      public function ivaProductoSubTotal($id, $subTotal) { //si funciona
        $rs = $this->db //rs=resultado
                ->select('iva')
                ->from('producto')
                ->where('producto_id', $id)
                ->get();
        $reg = $rs->row(); //reg = registro de resultado
        if ($reg) { //en el caso de obtener dato a la consulta
            //para saber la base pillo el iva/100 y luego le sumo 1= 1*21 que será el divisor
            $divisor= 1+($reg->iva/100);                    //redondeo de dos digitos al alza
            $baseImponible = round(($subTotal / $divisor), 2,PHP_ROUND_HALF_DOWN) ;
           // $baseImponible = $precioPostDescuento / (1 * $reg->iva) ;//sin el redondeo
            return ($subTotal - $baseImponible) ;
        } else { //en el caso de no obtener ningun resultado a la consulta
            return '';
        }
    }

      public function totalCompra($productosCarrito) { //SI  funciona
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
         //S print_r($datosCliente->usuario_id);
          //foreach ($datosCliente as $info) {
            //echo $info['usuario_id'];
              $datos=array(                 
                  'usuario_id' => $datosCliente->usuario_id,
                  'nombre_usuario_pedido' => $datosCliente->nombre,
                  'apellidos_pedido' => $datosCliente->apellidos,
                  'dni_pedido' => $datosCliente->dni
                );
         // }
          $this->db->insert('pedido', $datos);        
      }

}