<?php
use App\Controller\GenerateTestProductsController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

return static function () {
    $routeCollection = new RouteCollection();

    $routeCollection->add('generate-test-products', new Route('/api/v1/generate-test-products/', [
        '_controller' => GenerateTestProductsController::class
    ]));

    return $routeCollection;
};