<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilUsuario extends CI_Controller {

	/**
	 * Muestra el perfil del usuario
	 */
	public function index(){
        $this->load->model('Model_productos');
		$this->load->model('Model_Provincias');
		$this->load->model('Model_Login');
		$datos['provincias'] = $this->Model_Provincias->getProvincias();
		$datos['usuario'] = $this->Model_Login->getUsuario($this->session->usuario_id);
		
		$this->load->view('Plantilla', [
			'titulo' => 'Perfil de usuario',
			'cuerpo' => $this->load->view('PerfilUsuario',$datos,true)
 		]
	);
    }

		/**
		 * Modificacion de datos personales
		 */
    public function ModificarDatos(){
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('apellidos', 'apellidos', 'required');
		$this->form_validation->set_rules('direccion', 'direccion', 'required');

		if ($this->form_validation->run() == TRUE) {
			$this->load->model('Model_Login');
			$this->Model_Login->modificarDatosUsuario($this->input->post('nombre'),$this->input->post('apellidos'),$this->input->post('direccion'),$this->session->usuario_id);
			$this->session->unset_userdata('usuario_id');
			$this->session->unset_userdata('nombre');
			$this->session->unset_userdata('administrador');
			$this->load->view('Plantilla', [
				'titulo' => 'Datos modificados',
				'cuerpo' => $this->load->view('DatosUsuarioModificados',[],true)
			 ]);
		}
		 else {
			 # code...
		 }

	}
	
	/**
	 * Modificar contraseña
	 */
	public function cambiarContrasena(){
		$this->load->model('Model_Login');
		$this->load->model('Model_productos');
		$this->load->model('Model_Provincias');
		$this->form_validation->set_rules('contraseñaActual', 'contraseñaActual', 'required');
		$this->form_validation->set_rules('contraseña', 'contraseña', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($this->Model_Login->compruebaContrasena($this->input->post('contraseñaActual'))) {
				$this->Model_Login->modificarContrasena($this->input->post('contraseña'),$this->session->usuario_id);
				$datos['provincias'] = $this->Model_Provincias->getProvincias();
				$datos['usuario'] = $this->Model_Login->getUsuario($this->session->usuario_id);
				$datos['msg'] = 'Contraseña Modificada correctamente';
				
				$this->load->view('Plantilla', [
					'titulo' => 'Perfil de usuario',
					'cuerpo' => $this->load->view('PerfilUsuario',$datos,true)
				]);
			} else {
				$this->index();
			}
			
		}
	}

	/** 
	 * Confirmacion de borrado de usuario
	 */
	public function darDeBaja(){
		$this->load->view('Plantilla', [
			'titulo' => 'Dar De Baja',
			'cuerpo' => $this->load->view('confirmarBaja',[],true)
		]);			
	}

	/**
	 * Eliminacion de usuario
	 */
	public function eliminarUsuario(){
		$this->load->model('Model_Login');
		$this->Model_Login->darDeBaja($this->session->usuario_id);
		$this->session->unset_userdata('usuario_id');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('administrador');
		$this->load->view('Plantilla', [
			'titulo' => 'Dar De Baja',
			'cuerpo' => $this->load->view('bajaCorrecta',[],true)
		]);			
	}

}