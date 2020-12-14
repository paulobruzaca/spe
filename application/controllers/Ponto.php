<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ponto extends CI_Controller {

    public function registrarPonto($msg = NULL){
        $this->load->view('includes/header');
        if($msg == 0){
            $data['msg'] = "O CPF digitado não esta cadastrado!";
            $this->load->view('includes/msg_erro', $data);
        }else if($msg == 1){
            $data['msg'] = "Ponto registrado com sucesso!";
            $this->load->view('includes/msg_sucesso', $data);
        }else if($msg == 2){
            $data['msg'] = "Erro ao registrar o ponto, tente novamente!";
            $this->load->view('includes/msg_erro', $data);
        }
        $this->load->view('registrarPonto');
        $this->load->view('includes/footer');
    }

    public function registrar(){
        $this->load->model('usuario_model', 'usuario');
        $this->load->model('ponto_model', 'ponto');
        $cpf = $this->input->post('cpf');
        if($this->usuario->verificaCpf($cpf)){
            if($this->ponto->registrar($cpf)){
                $msg = 1;
                redirect('ponto/registrarPonto/'.$msg);
            }else{
                $msg = 2;
                redirect('ponto/registrarPonto/'.$msg);
            }
        }else{
            $msg = 0;
            redirect('ponto/registrarPonto/'.$msg);
        }
    }

	public function other() {
		if($this->session->userdata('logado') == true){
			$this->load->model('usuario_model', 'usuario');
            $data['usuario'] = $this->usuario->getUsuarios($this->session->userdata('idUsuario'));
		}else{
			redirect(base_url());
		}
		
	}
}
