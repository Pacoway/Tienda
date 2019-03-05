<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pruebaCorreo extends CI_Controller {
    
    public function index()
	{
        $this->load->library('email','','correo');

        $this->correo->from('tienda.paco.lm@gmail.com', 'Paco');
        $this->correo->to('pakoway_@hotmail.com');
        $this->correo->subject('This is an email test');
        $this->correo->message('This is the body of the message');
        $this->correo->attach(base_url().'img/prueba.txt');
      if($this->correo->send())
        {
         echo base_url().'img/prueba.txt';
        }
      
        else
        {
         show_error($this->correo->print_debugger());
        }
	}

}