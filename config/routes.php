<?php
use App\Controller\Api as ApiController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

return static function () {
    $routeCollection = new RouteCollection();

    $routeCollection->add('products-generate-test-products', new Route('/api/v1/products/generate-test-products/', [
        '_controller' => ApiController\Product\GenerateTestProductsController::class
    ]));

    $routeCollection->add('products-list', new Route('/api/v1/products/list/', [
        '_controller' => ApiController\Product\ProductsListController::class
    ]));

    $routeCollection->add('order-create', new Route('/api/v1/order/create/{slug}', [
        '_controller' => ApiController\Order\OrderCreateController::class
    ]));

    $routeCollection->add('order-pay', new Route('/api/v1/order/pay/{slug}', [
        '_controller' => ApiController\Order\PayOrderController::class
    ]));

    return $routeCollection;
};