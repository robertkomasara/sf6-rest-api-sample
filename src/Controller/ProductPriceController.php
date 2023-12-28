<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ProductPrice;
use App\Entity\Product;

class ProductPriceController extends ApiController
{
    public function add(Request $request): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->find($request->request->get('product'));

        $productPrice = new ProductPrice(
            array_merge(
                $request->request->all(),
                ['product' => $product]
            ) 
        ); 

        $errors = $this->validate([$productPrice]);

        if ( sizeof($errors )){
            return new JsonResponse((string)$errors,200);    
        }

        $this->entityManager->persist($productPrice);
        $this->entityManager->flush();

        return new JsonResponse($productPrice->id,200);
    }

    public function list(Request $request, int $productId = 0): JsonResponse
    {
        $productPriceRepository = $this->entityManager->getRepository(ProductPrice::class);
        $productPrices = $productPriceRepository->getProductPrices($productId);

        return new JsonResponse($productPrices,200);
    }

    public function view(Request $request, int $id = 0): JsonResponse
    {
        return $this->abstractView($request,ProductPrice::class,$id);
    }    

    public function delete(Request $request, int $id = 0): JsonResponse
    {
        return $this->abstractDelete($request,ProductPrice::class,$id);
    }
}
