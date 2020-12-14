<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function index() {
		if($this->session->userdata('logado') == true){
			$this->load->model('usuario_model', 'usuario');
			$data['usuario'] = $this->usuario->getUsuarios($this->session->userdata('idUsuario'));
			$this->load->view('includes/header');
			$this->load->view('panel', $data);
			$this->load->view('includes/footer');
		}else{
			redirect(base_url());
		}
		
	}
}
