<?php

namespace GestaoFrota_Doctrine\Controller\Veiculo;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VeiculoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
