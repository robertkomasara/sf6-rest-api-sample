<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

abstract class ApiController extends AbstractController
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected EntityManagerInterface $entityManager
    ){}

    abstract protected function add(Request $request): JsonResponse;
    abstract protected function list(Request $request): JsonResponse;

    protected function validate(array $entities): ConstraintViolationList
    {
        $validationErrors = new ConstraintViolationList();

        foreach ( $entities as $entity ):
            $validationErrors = $this->validator->validate($entity);
        endforeach;

        return $validationErrors;
    }

    protected function abstractView(Request $request, string $className, int $id = 0): JsonResponse
    {
        $obj = $this->entityManager->getRepository($className)->find($id);
        if (!$obj) new JsonResponse('Item not found',404);

        return new JsonResponse((string)$obj,200);
    }    

    protected function abstractDelete(Request $request, string $className, int $id = 0): JsonResponse
    {
        $obj = $this->entityManager->getRepository($className)->find($id);
        if (!$obj) new JsonResponse('Item not found',404);

        $this->entityManager->remove($obj);

        return new JsonResponse('Item deleted',200);
    }
}
