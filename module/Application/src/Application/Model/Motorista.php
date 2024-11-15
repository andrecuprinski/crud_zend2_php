<?php

namespace Application\Model;

class Motorista
{
    /**
     * Nome da tabela. Campo obrigatório
     * @var string
     */
    protected $tableName = 'motoristas';

    /**
     * Nome do campo da chave primária
     * @var string
     */
    protected $primaryKeyField = 'id_motorista';

    protected $id_motosita;

    /**
     * @var string(200)
     */
    protected $nome;

    /**
     * @var string(20)
     */
    protected $rg;

    /**
     * @var string(11)
     */
    protected $cpf;

    /**
     * @var string(20)
     */
    protected $telefone;

    /**
     * @var int
     */
    protected $id_veiculo;

    public function getIdMotorista()
    {
        return $this->id_motorista;
    }

    public function setIdMotorista($id_motorista)
    {
        $this->id_motorista = $id_motorista;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getIdVeiculo()
    {
        return $this->id_veiculo;
    }

    public function setIdVeiculo($id_veiculo)
    {
        $this->id_veiculo = $id_veiculo;
        return $this;
    }

    public function exchangeArray($data){
        $this
            ->setNome($data['nome'])
            ->setRg($data['rg'])
            ->setCpf($data['cpf'])
            ->setTelefone($data['telefone'])
            ->setIdVeiculo($data['id_veiculo']);
    }
}