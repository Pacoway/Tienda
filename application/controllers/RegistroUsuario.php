<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroUsuario extends CI_Controller {

	public function index(){
        $this->load->model('model_productos');
        $this->load->model('Model_provincias');
        $this->load->model('Model_Login');
        $datos_categorias['categorias']= $this->model_productos->getCategorias();

        //Añadir form validations

        if ($this->form_validation->run() == TRUE) {
            $this->model_Login->registroUsuario($this->input->post('nombre_usuario'),$this->input->post('contraseña'),$this->input->post('email'),$this->input->post('nombre'),$this->input->post('apellidos'),$this->input->post('dni'),$this->input->post('direccion'),$this->input->post('provincia'));
            $this->load->view('plantilla', [
                'titulo' => 'Registro con éxito',
                'menu'=>  $this->load->view('Menu', $datos_categorias, true),
                'cuerpo' => $this->load->view('RegistroCompletado',[],true)
            ]);
        } else {   
            $datos_provincias['provincias'] = $this->model_provincias->getProvincias();
            $this->load->view('plantilla', [
                'titulo' => 'Registrar usuario',
                'menu'=>  $this->load->view('Menu', $datos_categorias, true),
                'cuerpo' => $this->load->view('RegistroUsuario',$datos_provincias, true)
            ]);
        }
    }
}