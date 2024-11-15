<?php

namespace GestaoFrota\Entity;

class Veiculo
{
    public $id_veiculo;
    public $placa;
    public $renavam;
    public $modelo;
    public $marca;
    public $ano;
    public $cor;

    public function exchangeArray($data)
    {
        $this->id_veiculo = (isset($data['id_veiculo'])) ? $data['id_veiculo'] : null;
        $this->placa = (isset($data['placa'])) ? $data['placa'] : null;
        $this->renavam = (isset($data['renavam'])) ? $data['renavam'] : null;
        $this->modelo = (isset($data['modelo'])) ? $data['modelo'] : null;
        $this->marca = (isset($data['marca'])) ? $data['marca'] : null;
        $this->ano = (isset($data['ano'])) ? $data['ano'] : null;
        $this->cor = (isset($data['cor'])) ? $data['cor'] : null;
    }
}