<?php

class Usuario_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function getUsuarios($id = NULL){
        if($id != NULL){
            $this->db->where('idUsuario',$id);
        }else{
            $this->db->select('*');
            $this->db->where('status', 1);
        }
        return $this->db->get('usuarios')->result();
    }

    public function verificaCpf($cpf = NULL){
        $this->db->where('cpf', $cpf);
        $cpf = $this->db->get('usuarios')->result();
        if(count($cpf) > 0){
            return true;
        }else if(count($cpf) < 0){
            return false;
        }
    }

    public function cadastrar(){
        $this->db->select('idUsuario');
        $this->db->where('cpf', $this->input->post('cpf'));
        $usuario = $this->db->get('usuarios')->result();
        //Se retornar maior que 0 é que o CPF já esta cadastrado
        if(count($usuario) > 0){
            return false;
        }else{
            $data['nome'] = $this->input->post('nome');
            $data['sobrenome'] = $this->input->post('sobrenome');
            $data['cpf'] = $this->input->post('cpf');
            $data['email'] = $this->input->post('email');
            $data['senha'] = MD5($this->input->post('senha'));
            $data['admin'] = $this->input->post('admin');
    
            return $this->db->insert('usuarios', $data);
        }
    }

    public function salvarAlteracao(){
        $data['nome'] = $this->input->post('nome');
        $data['sobrenome'] = $this->input->post('sobrenome');
        $data['cpf'] = $this->input->post('cpf');
        $data['email'] = $this->input->post('email');
        $data['senha'] = MD5($this->input->post('senha'));
        $data['admin'] = $this->input->post('admin');

        $this->db->where('idUsuario', $this->input->post('idUsuario'));
        return $this->db->update('usuarios', $data);
    }

    public function atualizarFoto($data = NULL, $id = NULL){
        $this->db->where('idUsuario', $id);
        return $this->db->update('usuarios', $data);
    }

    public function salvarSenha(){
        $data['senha'] = MD5($this->input->post('senha'));
        $this->db->where('idUsuario', $this->input->post('idUsuario'));
        return $this->db->update('usuarios',$data);
    }
    /* O usuário não é excluido, será mudado o status dele para 0 (desativado),
    * caso seja necessário uma pesquisa futura sobre as informações do mesmo.
    */
    public function excluir($id = NULL){
        $this->db->where('idUsuario', $id);
        $data['status'] = 0;
        return $this->db->update('usuarios', $data);
    }
}