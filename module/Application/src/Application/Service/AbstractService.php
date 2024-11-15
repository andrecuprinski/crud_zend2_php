<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

abstract class AbstractService
{

    protected $em;
    protected $entity;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Array $data = [])
    {
        if (isset($data['id'])) {
            $entity = $this->em->getReference($this->entity, $data['id']);
        } else {
            $entity = new $this->entity();
        }

        foreach ($data as $key => $value) {
            $set = 'set' . ucfirst($key);
            $entity->$set($value);
        }

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(Array $data = [])
    {
        $entity = $this->em->getRepository($this->entity)->findOneBy($data);

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $entity;
        }
    }
}