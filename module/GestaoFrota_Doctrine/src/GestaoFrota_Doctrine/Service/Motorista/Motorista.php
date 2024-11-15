<?php

namespace GestaoFrota_Doctrine\Service\Motorista;

use Doctrine\ORM\EntityManager;

class Motorista
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getMotoristas()
    {
        // Consulta todos os motoristas
        $motoristas = $this->entityManager->getRepository('GestaoFrota\Entity\Motorista')->findAll();
        return $motoristas;
    }
}