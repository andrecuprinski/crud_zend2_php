<?php

namespace GestaoFrota\Service\Veiculo;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\{Select, Sql};

/**
 * Class Veiculo
 * @package GestaoFrota\Service\Veiculo
 */
class Veiculo
{
    /**
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     * Veiculo constructor.
     * @param Adapter $dbAdapter
     */
    public function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * Função responsável por relaizar a consulta dos veículos cadastrados
     * @return array
     */
    public function getVeiculos()
    {
        $select = new Select();
        $select->from('veiculos')
            ->columns(['id_veiculo', 'placa', 'renavam', 'modelo', 'marca', 'ano', 'cor']);

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $veiculos = [];
        foreach ($result as $row) {
            $veiculos[] = $row;
        }
        return $veiculos;
    }

    /**
     * Função responsável por realizar a consulta do modelo do veículo
     * @param $placa
     * @return array
     */
    public function getIdVeiculo($placa)
    {
        $select = new Select();
        $select->from('veiculos')
            ->columns(['id_veiculo'])
            ->where(['placa' => $placa['placaVeiculo']]);

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $veiculo = [];
        foreach ($result as $row) {
            $veiculo['id_veiculo'] = $row;
        }

        return $veiculo;
    }

    /**
     * Função responsável por inserir um novo veículo
     * @param array $data
     * @return array
     */
    public function insertVeiculo(array $data)
    {
        $verificaPlaca = $this->verificaPlaca($data['placa']);
        if (!$verificaPlaca['sucesso']) {
            return $verificaPlaca;
        }

        if (isset($data['renavam'])) {
            $verificaRenavam = $this->verificaRenavam($data['renavam']);
            if (!$verificaRenavam['sucesso']) {
                return $verificaRenavam;
            }
        }

        $connection = $this->dbAdapter->getDriver()->getConnection();
        try {
            $connection->beginTransaction();

            $sql = new Sql($this->dbAdapter);
            $insert = $sql->insert('veiculos');
            $insert->values([
                'ano' => $data['ano'],
                'cor' => $data['cor'],
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'placa' => $data['placa'],
                'renavam' => $data['renavam']
            ]);

            $statement = $sql->prepareStatementForSqlObject($insert);
            $statement->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Veículo cadastrado com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar veículo.'
            ];
        }
    }

    /**
     * Função responsável por editar um veículo
     * @param array $data
     * @return array
     */
    public function editaVeiculo(array $data)
    {
        $connection = $this->dbAdapter->getDriver()->getConnection();
        try {
            $connection->beginTransaction();

            $sql = new Sql($this->dbAdapter);
            $update = $sql->update('veiculos');
            $update->set([
                'ano' => $data['ano'],
                'cor' => $data['cor'],
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'placa' => $data['placa'],
                'renavam' => $data['renavam']
            ]);
            $update->where(['id_veiculo' => $data['id']]);

            $statement = $sql->prepareStatementForSqlObject($update);
            $statement->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Veículo editado com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao editar veículo.'
            ];
        }
    }

    /**
     * Função responsável por excluir um veículo
     * @param array $data
     * @return array
     */
    public function excluiVeiculo(array $data)
    {
        $connection = $this->dbAdapter->getDriver()->getConnection();
        try {
            $connection->beginTransaction();

            $sql = new Sql($this->dbAdapter);
            $delete = $sql->delete('veiculos');
            $delete->where(['id_veiculo' => $data['id']]);

            $statement = $sql->prepareStatementForSqlObject($delete);
            $statement->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Veículo excluído com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao excluir veículo.'
            ];
        }
    }

    /**
     * Função responsável por verificar se a placa já está cadastrada
     * @param $placa
     * @return array
     */
    private function verificaPlaca($placa)
    {
        $select = new Select();
        $select->from('veiculos')
            ->columns(['placa'])
            ->where(['placa' => $placa]);

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $veiculo = [];
        foreach ($result as $row) {
            $veiculo['placa'] = $row;
        }

        if (!empty($veiculo)) {
            return [
                'sucesso' => false,
                'mensagem' => 'Placa já cadastrada.'
            ];
        }
        return [
            'sucesso' => true,
        ];
    }

    /**
     * Função responsável por verificar se o renavam já está cadastrado
     * @param $renavam
     * @return array
     */
    private function verificaRenavam($renavam)
    {
        $select = new Select();
        $select->from('veiculos')
            ->columns(['renavam'])
            ->where(['renavam' => $renavam]);

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $veiculo = [];
        foreach ($result as $row) {
            $veiculo['renavam'] = $row;
        }

        if (!empty($veiculo)) {
            return [
                'sucesso' => false,
                'mensagem' => 'Renavam já cadastrado.'
            ];
        }
        return [
            'sucesso' => true,
        ];
    }
}