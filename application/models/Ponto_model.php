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
            $this->db->where('cpf', $cpf);
            $this->db->where('data', date('Y-m-d'));
            $registro = $this->db->get('ponto')->result();
            if(count($registro) == 0){
                $data['cpf'] = $cpf;
                $data['data'] = date('Y-m-d');
                $data['marcacao1'] = date('H:i');
                return $this->db->insert('ponto', $data);
            }else{
                if($registro[0]->marcacao2 == NULL){
                    $data['marcacao2'] = date('H:i');
                    $this->db->where('cpf',$cpf);
                    return $this->db->update('ponto', $data);
                }else if($registro[0]->marcacao3 == NULL){
                    $data['marcacao3'] = date('H:i');
                    $this->db->where('cpf',$cpf);
                    return $this->db->update('ponto', $data);
                }else if($registro[0]->marcacao4 == NULL){
                    $data['marcacao4'] = date('H:i');
                    $this->db->where('cpf',$cpf);
                    return $this->db->update('ponto', $data);
                }else if($registro[0]->marcacao4 != NULL){
                    return false;
                }
            }
            
        }else{
            return false;
        }
    }
    //VErificar como realizar pesquisa entre datas, verificar como posso fazar para pesquisar por apenas 1 dia.
    public function buscarPonto($cpf = NULL, $dataInicio = NULL, $dataFim = NULL){
        if($cpf != NULL){
            $this->db->where('cpf', $cpf);
            if($dataInicio == NULL && $dataFim == NULL){
                $this->db->where('data', date("Y-m-d"));
            }else if($dataInicio != NULL && $dataFim == NULL){
                $data = str_replace("/", "-", $dataInicio);
                $dataI = date('Y-m-d', strtotime($data));
                $this->db->where('data', $dataI);
            }else if($dataInicio != NULL && $dataFim != NULL){
                $dataF = str_replace("/", "-", $dataInicio);
                $dataIn = date('Y-m-d', strtotime($dataF));
                $dataS = str_replace("/", "-", $dataFim);
                $dataOut = date('Y-m-d', strtotime($dataS));

                $this->db->where('data BETWEEN "'.$dataIn.'" and "'.$dataOut.'"');
            }
            
            return $this->db->get('ponto')->result();
        }else{
            return false;
        }
    }
}