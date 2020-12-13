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
        }
        return $this->db->get('usuarios')->result();
    }

    public function cadastrar(){
        $data['nome'] = $this->input->post('nome');
        $data['sobrenome'] = $this->input->post('sobrenome');
        $data['cpf'] = $this->input->post('cpf');
        $data['email'] = $this->input->post('email');
        $data['senha'] = MD5($this->input->post('senha'));
        $data['admin'] = $this->input->post('admin');

        return $this->db->insert('usuarios', $data);
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

    public function excluir($id = NULL){
        $this->db->where('idUsuario', $id);
        return $this->db->delete('usuarios');
    }
}