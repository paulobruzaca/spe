<?php

class Ponto_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function getPonto($cpf = NULL){
        if($cpf != NULL){
            $this->db->where('cpf',$cpf);
        }else{
            $this->db->select('*');
        }
        return $this->db->get('ponto')->result();
    }

    public function registrar($cpf = NULL){
        if($cpf != NULL){
           $data['cpf'] = $cpf;
           $data['data'] = date('Y-m-d');
           $data['hora'] = date('H:i');
           return $this->db->insert('ponto', $data);
        }else{
            return false;
        }
    }
}