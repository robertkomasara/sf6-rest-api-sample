<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ProductController extends ApiController
{
    public function add(Request $request): JsonResponse
    {
        $product = new Product(
            $request->request->all()
        ); 

        $errors = $this->validate([$product]);

        if ( sizeof($errors )){
            return new JsonResponse((string)$errors,200);    
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse($product->id,200);
    }

    public function list(Request $request, int $page = 0): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $products = $productRepository->getProducts($page);

        var_dump($products); die();

        return new JsonResponse($products,200);
    }

    public function view(Request $request, int $id = 0): JsonResponse
    {
        return $this->abstractView($request,Product::class,$id);
    }    

    public function delete(Request $request, int $id = 0): JsonResponse
    {
        return $this->abstractDelete($request,Product::class,$id);
    }
}
