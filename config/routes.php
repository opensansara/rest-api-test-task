<?php
use App\Controller\Api\Product\GenerateTestProductsController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

return static function () {
    $routeCollection = new RouteCollection();

    $routeCollection->add('generate-test-products', new Route('/api/v1/products/generate-test-products/', [
        '_controller' => GenerateTestProductsController::class
    ]));

    $routeCollection->add('generate-test-products', new Route('/api/v1/products/list/', [
        '_controller' => GenerateTestProductsController::class
    ]));

    return $routeCollection;
};