<?php
namespace App\Controller\Api\Product;

use App\Controller\Api\ApiBaseController;
use App\Model\Product\Repository\ProductRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsListController extends ApiBaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductsListController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws DBALException
     */
    public function process(Request $request): Response
    {
        $products = $this->productRepository->findAll();

        $responseData = [
            'items' => [],
            'meta' => [
                'total' => count($products)
            ]
        ];

        foreach ($products as $product) {
            $responseData['items'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ];
        }

        return $this->successResponse($responseData);
    }
}