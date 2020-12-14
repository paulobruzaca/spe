<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function listar($indice = NULL) {
        if($this->session->userdata('logado') == true){
            $this->load->model('usuario_model', 'usuario');
            $data['usuarios'] = $this->usuario->getUsuarios();
            $this->load->view('includes/header');
            if($indice == 1){
                $d['msg'] = "Usuário Cadastrado com Sucesso.";
                $this->load->view('includes/msg_sucesso', $d);
            }else if($indice == 2){
                $d['msg'] = "Erro ao Cadastrar Usuário.";
                $this->load->view('includes/msg_erro',$d);
            }else if($indice == 3){
                $d['msg'] = "Sucesso ao realizar a alteração.";
                $this->load->view('includes/msg_sucesso',$d);
            }else if($indice == 4){
                $d['msg'] = "Erro ao Atualizar Usuário.";
                $this->load->view('includes/msg_erro',$d);
            }else if($indice == 5){
                $d['msg'] = "Foto atualizada.";
                $this->load->view('includes/msg_sucesso',$d);
            }else if($indice == 6){
                $d['msg'] = "Erro ao Atualizar Foto.";
                $this->load->view('includes/msg_erro',$d);
            }else if($indice == 7){
                $d['msg'] = "Senha atualizada.";
                $this->load->view('includes/msg_sucesso',$d);
            }else if($indice == 8){
                $d['msg'] = "Erro ao Atualizar a Senha.";
                $this->load->view('includes/msg_erro',$d);
            }else if($indice == 9){
                $d['msg'] = "Exclusão efetuada com sucesso.";
                $this->load->view('includes/msg_sucesso',$d);
            }else if($indice == 10){
                $d['msg'] = "Erro ao excluir.";
                $this->load->view('includes/msg_erro',$d);
            }
            $this->load->view('usuarios', $data);
            $this->load->view('includes/footer');
        }else{
            redirect(base_url());
        }
    }

    public function cadastroUsuario(){
        if($this->session->userdata('logado') == true){
            $this->load->view('includes/header');
            $this->load->view('cadastroUsuario');
            $this->load->view('includes/footer');
        }else{
            redirect(base_url());
        }
    }

    public function cadastrar(){
        $this->load->model('usuario_model', 'usuario');
        if($this->usuario->cadastrar()){
            redirect('usuario/listar/1');
        }else{
            redirect('usuario/listar/2');
        }
    }

    public function editarUsuario($id = NULL){
        if($this->session->userdata('logado') == true){
            $this->load->model('usuario_model','usuario');
            $data['usuario'] = $this->usuario->getUsuarios($id);
            $this->load->view('includes/header');
            $this->load->view('editarUsuario', $data);
            $this->load->view('includes/footer');
        }else{
            redirect(base_url());
        }
    }

    public function salvarAlteracao(){
        $this->load->model('usuario_model', 'usuario');
        if($this->usuario->salvarAlteracao()){
            redirect('usuario/listar/3');
        }else{
            redirect('usuario/listar/4');
        }
    }

    public function uploadFoto($id = NULL){
        if($this->session->userdata('logado') == true){
            $this->load->model('usuario_model','usuario');
            $data['usuario'] = $this->usuario->getUsuarios($id);
            $this->load->view('includes/header');
            $this->load->view('fotoUsuario', $data);
            $this->load->view('includes/footer');
        }else{
            redirect(base_url());
        }
    }

    public function upload(){
        $this->load->model('usuario_model', 'usuario');
        $cpf          = $this->input->post('cpf');
        $fotoUsuario    = $_FILES['fotoUsuario'];
        $configuracao = array(
           'upload_path'   => './assets/fotos/',
           'allowed_types' => 'jpg|jpeg',
           'file_name'     => $cpf.'.jpg',
           'max_size'      => '5000'
        );
        $this->load->library('upload');
        $this->upload->initialize($configuracao);
        $data['fotoUsuario'] = $cpf.'.jpg';
        if($this->upload->do_upload('fotoUsuario')){
            $this->usuario->atualizarFoto($data, $this->input->post('idUsuario'));
            redirect('usuario/listar/5');
        }else{
            redirect('usuario/listar/6');
        }
    }

    public function alterarSenha($id = NULL){
        if($this->session->userdata('logado') == true){
            $this->load->model('usuario_model','usuario');
            $data['usuario'] = $this->usuario->getUsuarios($id);
            $this->load->view('includes/header');
            $this->load->view('alterarSenha', $data);
            $this->load->view('includes/footer');        
        }else{
            redirect(base_url());
        }
    }

    public function salvarSenha(){
        $this->load->model('usuario_model', 'usuario');
        if($this->usuario->salvarSenha()){
            redirect('usuario/listar/7');
        }else{
            redirect('usuario/listar/8');
        }
    }

    public function excluirUsuario($id = NULL){
        $this->load->model('usuario_model', 'usuario');
        if($this->usuario->excluir($id)){
            redirect('usuario/listar/9');
        }else{
            redirect('usuario/listar/10');
        }
    }
}
