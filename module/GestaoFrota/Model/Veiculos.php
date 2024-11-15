<?php

namespace GestaoFrota\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Veiculos
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAll()
    {
        return $this->tableGateway->select();
    }

    public function getById($id)
    {
        $result = $this->tableGateway->select(['id_veiculo' => $id]);
        return $result->current();
    }

    public function save(Veiculos $veiculo)
    {
        $data = [
            'placa'   => $veiculo->placa,
            'renavam' => $veiculo->renavam,
            'modelo'  => $veiculo->modelo,
            'marca'   => $veiculo->marca,
            'ano'     => $veiculo->ano,
            'cor'     => $veiculo->cor,
        ];

        $id = (int) $veiculo->id_veiculo;

        if ($id === 0) {
            // Inserting new record
            $this->tableGateway->insert($data);
        } else {
            if ($this->getById($id)) {
                // Updating existing record
                $this->tableGateway->update($data, ['id_veiculo' => $id]);
            } else {
                throw new \Exception('Veículo não encontrado');
            }
        }
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id_veiculo' => $id]);
    }
}
