<?php

namespace GestaoFrota\Service\Motorista;

use GestaoFrota\Service\Veiculo\Veiculo;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\{Delete, Insert, Select, Sql, Update};

/**
 * Class Motorista
 * @package GestaoFrota\Service\Motorista
 */
class Motorista
{
    /**
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     * @var Veiculo
     */
    protected $veiculoService;


    /**
     * Motorista constructor.
     * @param Adapter $dbAdapter
     * @param Veiculo $veiculoService
     */

    public function __construct(
        Adapter $dbAdapter,
        Veiculo $veiculoService
    )
    {
        $this->dbAdapter = $dbAdapter;
        $this->veiculoService = $veiculoService;

    }

    /**
     * Função responsável por relaizar a consulta dos motoristas cadastrados e seus respectiovs veiuclos
     * @return array
     */
    public function getMotoristas()
    {
        $select = new Select();
        $select->from('motoristas')
            ->columns(['id_motorista', 'nome', 'rg', 'cpf', 'telefone'])
            ->join('veiculos', 'motoristas.id_veiculo = veiculos.id_veiculo', ['veiculo' => 'modelo', 'placa'], 'left');

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $motoristas = [];
        foreach ($result as $row) {
            $motoristas[] = $row;
        }

        return $motoristas;
    }

    /**
     * Função responsável por inserir um novo motorista
     * @param array $data
     * @return array
     */
    public function insertMotorista(array $data)
    {
        $cpfCadastrado = $this->validaCpfCadastrado($data['cpf']);
        if (!$cpfCadastrado['sucesso']) {
            return $cpfCadastrado;
        }

        $dadosInsert = [
            'nome' => $data['nome'],
            'rg' => $data['rg'],
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone']
        ];
        if (isset($data['placaVeiculo']) && $data['placaVeiculo'] != null) {
            $veiculo = $this->veiculoService->getIdVeiculo($data);

            if (empty($veiculo)) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Opa, veículo não encontrado.'
                ];
            }

            $dadosInsert['id_veiculo'] = current($veiculo['id_veiculo']);
        }

        $connection = $this->dbAdapter->getDriver()->getConnection();

        try {
            $connection->beginTransaction();
            $insert = new Insert('motoristas');
            $insert->values($dadosInsert);

            $sql = new Sql($this->dbAdapter);
            $sql->prepareStatementForSqlObject($insert)->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Motorista cadastrado com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar motorista.'
            ];
        }
    }

    /**
     * Função responsável por editar os dados do motorista
     * @param array $data
     * @return array
     */
    public function editaMotorista(array $data)
    {
        $dadosUpdate = [
            'nome' => $data['nome'],
            'rg' => $data['rg'],
            'telefone' => $data['telefone'],
            'id_veiculo' => null
        ];

        if (!empty($data['placaVeiculo']) && $data['placaVeiculo'] !== '') {
            $veiculo = $this->veiculoService->getIdVeiculo($data);
            if (empty($veiculo)) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Opa, veículo não encontrado.'
                ];
            }
            $dadosUpdate['id_veiculo'] = current($veiculo['id_veiculo']);
        }

        $connection = $this->dbAdapter->getDriver()->getConnection();
        try {
            $connection->beginTransaction();
            $update = new Update('motoristas');

            $update->set($dadosUpdate);
            $update->where(['id_motorista' => $data['id']]);
            $sql = new Sql($this->dbAdapter);
            $sql->prepareStatementForSqlObject($update)->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Motorista editado com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao editar motorista.'
            ];
        }
    }

    /**
     * Função responsável por excluir um motorista
     * @param array $data
     * @return array
     */
    public function excluiMotorista(array $data)
    {
        $connection = $this->dbAdapter->getDriver()->getConnection();
        try {
            $connection->beginTransaction();
            $delete = new Delete('motoristas');
            $delete->where([
                'id_motorista' => $data['id']
            ]);
            $sql = new Sql($this->dbAdapter);
            $sql->prepareStatementForSqlObject($delete)->execute();

            $connection->commit();

            return [
                'sucesso' => true,
                'mensagem' => 'Motorista excluído com sucesso!'
            ];
        } catch (\Exception $e) {
            $connection->rollback();
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao excluir motorista.'
            ];
        }
    }

    /**
     * Função responsável por validar se o CPF informado já está cadastrado
     * @param $cpf
     * @return array
     */
    private function validaCpfCadastrado($cpf)
    {
        $select = new Select();
        $select->from('motoristas')
            ->columns(['cpf'])
            ->where(['cpf' => $cpf]);

        $sql = new Sql($this->dbAdapter);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $motoristas = [];
        foreach ($result as $row) {
            $motoristas[] = $row;
        }

        if (!empty($motoristas)) {
            return [
                'sucesso' => false,
                'mensagem' => 'Opa, esse CPF já está cadastrado.'
            ];
        }
        return [
            'sucesso' => true
        ];
    }
}

