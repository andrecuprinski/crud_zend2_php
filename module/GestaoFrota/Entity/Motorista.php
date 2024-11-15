<?php

namespace GestaoFrota\Entity;

class Motorista
{
    public $id_motorista;
    public $nome;
    public $rg;
    public $cpf;
    public $telefone;
    public $id_veiculo;

    public function exchangeArray($data)
    {
        $this->id_motorista = (isset($data['id_motorista'])) ? $data['id_motorista'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->rg = (isset($data['rg'])) ? $data['rg'] : null;
        $this->cpf = (isset($data['cpf'])) ? $data['cpf'] : null;
        $this->telefone = (isset($data['telefone'])) ? $data['telefone'] : null;
        $this->id_veiculo = (isset($data['id_veiculo'])) ? $data['id_veiculo'] : null;
    }
}