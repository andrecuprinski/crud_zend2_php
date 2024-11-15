<?php

namespace GestaoFrota\Controller\Veiculo;

use GestaoFrota\Service\Motorista\Motorista;
use GestaoFrota\Service\Veiculo\Veiculo;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\{JsonModel, ViewModel};

/**
 * Class VeiculoController
 * @package GestaoFrota\Controller\Veiculo
 */
class VeiculoController extends AbstractActionController
{
    /**
     * @var Motorista
     */
    protected $veiculoService;

    /**
     * VeiculoController constructor.
     * @param Veiculo $veiculoService
     */
    public function __construct(Veiculo $veiculoService)
    {
        $this->veiculoService = $veiculoService;
    }

    /**
     * Função responsável por realizar a chamada da listagem de veículos
     * @return ViewModel
     */
    public function indexAction()
    {
        $veiculos = $this->veiculoService->getVeiculos();
        return new ViewModel(['veiculos' => $veiculos]);
    }

    /**
     * Função responsável por realizar a chamada do cadastro do veículo
     * @return JsonModel
     */
    public function cadastraVeiculoAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar veiculo.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $insertVeiculo = $this->veiculoService->insertVeiculo($data);

        if (!$insertVeiculo['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $insertVeiculo['mensagem']
            ]);
        }
        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Veiculo cadastrado com sucesso!'
        ]);
    }

    /**
     * Função responsável por realizar a chamada da edição do veículo
     * @return JsonModel
     */
    public function editaVeiculoAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => 'Erro ao editar veiculo.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $editaVeiculo = $this->veiculoService->editaVeiculo($data);

        if (!$editaVeiculo['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $editaVeiculo['mensagem']
            ]);
        }
        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Veiculo editado com sucesso!'
        ]);
    }

    /**
     * Função responsável por realizar a chamada da exclusão do veículo
     * @return JsonModel
     */
    public function excluiVeiculoAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'mensagem' => 'Erro ao excluir veiculo.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $excluiVeiculo = $this->veiculoService->excluiVeiculo($data);

        if (!$excluiVeiculo['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $excluiVeiculo['mensagem']
            ]);
        }
        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Veiculo excluido com sucesso!'
        ]);
    }
}