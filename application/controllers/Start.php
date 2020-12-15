<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	public function login(){
        if($this->session->userdata('logado') == true){
            redirect('panel');
        }else{
            $this->load->view('includes/header');
            $this->load->view('start');
            $this->load->view('includes/footer');
        }
    }

    public function access(){
        //Recebendo os dados do formulário
        $user = $this->input->post('user');
        $pass = md5($this->input->post('password'));
        //Realizando a pesquisa no banco
        $this->db->where('cpf', $user);
        $this->db->where('senha', $pass);
        $data['usuario'] = $this->db->get('usuarios')->result();
        //Verificando se houve retorno da pesquisa
        if(count($data['usuario']) == 1){
            if($data['usuario'][0]->status == 0){
                echo "<h1>Usuario desativado.<h1>";
            }else{
                //Adionoando dados a Session
                $d['idUsuario'] = $data['usuario'][0]->idUsuario;
                $d['admin'] = $data['usuario'][0]->admin;
                $d['status'] = $data['usuario'][0]->status;
                $d['logado'] = true;
                $this->session->set_userdata($d);
                redirect('panel');
            }
        }
    }
    //Função para destruir a Session
    public function exit(){
        $d['idUsuario'] = '';
        $d['admin'] = '';
        $d['logado'] = false;
        $this->session->set_userdata($d);
        redirect(base_url());
    }
}
