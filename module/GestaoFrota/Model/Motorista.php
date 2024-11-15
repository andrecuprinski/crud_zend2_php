<?php

namespace GestaoFrota\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Motorista
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
        $result = $this->tableGateway->select(['id_motorista' => $id]);
        return $result->current();
    }

    public function save(Motorista $motorista)
    {
        $data = [
            'nome'       => $motorista->nome,
            'rg'         => $motorista->rg,
            'cpf'        => $motorista->cpf,
            'telefone'   => $motorista->telefone,
            'id_veiculo' => $motorista->id_veiculo,
        ];

        $id = (int) $motorista->id_motorista;

        if ($id === 0) {
            // Inserting new record
            $this->tableGateway->insert($data);
        } else {
            if ($this->getById($id)) {
                // Updating existing record
                $this->tableGateway->update($data, ['id_motorista' => $id]);
            } else {
                throw new \Exception('Motorista não encontrado');
            }
        }
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id_motorista' => $id]);
    }
}
