<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroUsuario extends CI_Controller {

	public function index(){
        $this->load->model('model_productos');
        $this->load->model('Model_Provincias');
        $this->load->model('Model_Login');
        $datos_categorias['categorias']= $this->model_productos->getCategorias();
        $datos_provincias['provincias'] = $this->Model_Provincias->getProvincias();

        $this->form_validation->set_rules('nombre_usuario', 'nombre_usuario', 'required');
        $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required');
        $this->form_validation->set_rules('dni', 'dni', 'required');
        $this->form_validation->set_rules('direccion', 'direccion', 'required');
        $this->form_validation->set_rules('provincia', 'provincia', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Model_Login->registroUsuario($this->input->post('nombre_usuario'),$this->input->post('contraseña'),$this->input->post('email'),$this->input->post('nombre'),$this->input->post('apellidos'),$this->input->post('dni'),$this->input->post('direccion'),$this->input->post('provincia'));
           
            $this->session->set_userdata('usuario_id', $this->Model_Login->getID($this->input->post('nombre_usuario')));
			$this->session->set_userdata('nombre', $this->Model_Login->getNombre($this->input->post('nombre_usuario')));
			$this->session->set_userdata('administrador', $this->Model_Login->getAdmin($this->input->post('nombre_usuario')));

            $this->load->view('plantilla', [
                'titulo' => 'Registro con éxito',
                'menu'=>  $this->load->view('Menu', $datos_categorias, true),
                'cuerpo' => $this->load->view('RegistroCompletado',[],true)
            ]);
        } else {   
            $this->load->view('plantilla', [
                'titulo' => 'Registrar usuario',
                'menu'=>  $this->load->view('Menu', $datos_categorias, true),
                'cuerpo' => $this->load->view('RegistroUsuario',$datos_provincias, true)
            ]);
        }
    }
}