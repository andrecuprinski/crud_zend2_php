<?php

namespace GestaoFrota\Controller\Motorista;

use GestaoFrota\Service\Motorista\Motorista;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\{JsonModel, ViewModel};

/**
 * Class MotoristaController
 * @package GestaoFrota\Controller\Motorista
 */
class MotoristaController extends AbstractActionController
{
    /**
     * @var Motorista
     */
    protected $motoristaService;

    /**
     * MotoristaController constructor.
     * @param Motorista $motoristaService
     */
    public function __construct(Motorista $motoristaService)
    {
        $this->motoristaService = $motoristaService;
    }

    /**
     * Função responsável por realizar a chamada da listagem de motoristas
     * @return ViewModel
     */
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $motoristas = $this->motoristaService->getMotoristas();
        $viewModel->setVariable('motoristas', $motoristas);
        return $viewModel->setTemplate('gestao-frota/motorista/index.phtml');
    }

    /**
     * Função responsável por realizar a chamada do cadastro do motorista
     * @return JsonModel
     */
    public function cadastraMotoristaAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'mensagem' => 'Erro ao cadastrar motorista.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $addMotorista = $this->motoristaService->insertMotorista($data);

        if (!$addMotorista['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $addMotorista['mensagem']
            ]);
        }

        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Motorista cadastrado com sucesso!'
        ]);
    }

    /**
     * Função responsável por realizar a chamda da ediação do motorista
     * @return JsonModel
     */
    public function editaMotoristaAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'mensagem' => 'Ocorreu um erro ao carregar os dados, recarregue a página e tente novamente.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $editaMotorista = $this->motoristaService->editaMotorista($data);

        if (!$editaMotorista['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $editaMotorista['mensagem']
            ]);
        }

        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Motorista editado com sucesso!'
        ]);
    }

    /**
     * Função responsável por realizar a chamada da exclusão do motorista
     * @return JsonModel
     */
    public function excluiMotoristaAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'mensagem' => 'Ocorreu um erro ao excluir o motorista, recarregue a página e tente novamente.'
            ]);
        }

        $data = $this->getRequest()->getPost()->toArray();
        $excluiMotorista = $this->motoristaService->excluiMotorista($data);

        if (!$excluiMotorista['sucesso']) {
            return new JsonModel([
                'sucesso' => false,
                'mensagem' => $excluiMotorista['mensagem']
            ]);
        }

        return new JsonModel([
            'sucesso' => true,
            'mensagem' => 'Motorista excluído com sucesso!'
        ]);
    }
}
