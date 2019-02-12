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
    public function productosDestacados() //importate PAGINAR
    {//$desde, $por_pagina pendientes de pasar por parametros a la función para cuando pagine
     // $query  = ("select * from producto where destacado=1 and visible=1 and finicio_dest<=CURDATE() and ffin_dest>=CURDATE() LIMIT $desde,$por_pagina");
        $rs = $this->db
        ->from('producto')
        ->where('destacado', 1)
        ->where('visible', 1)
        ->get();
        return $rs->result();//No usar result array, si en la vista quiero usar un foreach normalito
        //return $prodes->result_array();
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

        return $rs->result();
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

}