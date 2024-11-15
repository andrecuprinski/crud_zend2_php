<?php

namespace GestaoFrota_Doctrine\Controller\Motorista;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use GestaoFrota\Entity\Motorista;

class MotoristaController extends AbstractActionController
{
    protected $objectManager;

    public function __construct(EntityManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
    public function indexAction()
    {
        //testando chamada direta no controller
        $motorista = $this->objectManager->getRepository(Motorista::class)->findAll();
        var_dump($motorista);die;
        $viewModel = new ViewModel();
        return $viewModel->setTemplate('gestao-frota-doctrine/motorista/index.phtml');
    }

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

        return new JsonModel([
            'success' => true,
            'mensagem' => 'Motorista cadastrado com sucesso!'
        ]);
    }
}
