<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Login extends CI_Model {

    public function __construct() { 
        $this->load->database();
    }

    public function LogOk($usuario, $contrasena)
    {
        $rs = $this->db
            ->select('nombre_usuario, contraseña')
            ->from('usuario')
            ->where('nombre_usuario', $usuario)
            ->where('contraseña', $contrasena)
            ->get();

        $reg= $rs->row();
        if ($reg) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getId($usuario){
        $rs = $this->db
            ->select('usuario_id')
            ->from('usuario')
            ->where('nombre_usuario', $usuario)
            ->get();

        $reg= $rs->row();
        if ($reg) {
            return $reg->usuario_id;
        }
        else {
            return '';
        }
    }

    public function getNombre($usuario){
        $rs = $this->db
            ->select('nombre')
            ->from('usuario')
            ->where('nombre_usuario', $usuario)
            ->get();

        $reg= $rs->row();
        if ($reg) {
            return $reg->nombre;
        }
        else {
            return '';
        }
    }

    public function getAdmin($usuario){
        $rs = $this->db
            ->select('administrador')
            ->from('usuario')
            ->where('nombre_usuario', $usuario)
            ->get();

        $reg= $rs->row();
        if ($reg) {
            if ($reg->administrador) {
                return 'Si';
            } else {
                return 'No';
            }
            
        }
        else {
            return '';
        }
    }
}