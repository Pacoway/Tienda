<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Provincias extends CI_Model {

    public function __construct() { 
        $this->load->database();
    }

    /**
     * Saca las provincias
     */
    public function getProvincias() {
        $rs = $this->db->get('provincias');
        return $rs->result();
    }

}