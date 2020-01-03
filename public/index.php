<?php
/**
 * @var ServiceManager $serviceContainer
 */

use App\Controller\ApiBaseController;
use App\Controller\ApiErrorController;
use App\Controller\ContainerAwareInterface;
use App\Controller\ControllerInterface;
use App\Infrastructure\API\ApiErrorsDescriptor;
use App\Infrastructure\API\ApiResponseBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\ClosureLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Zend\ServiceManager\ServiceManager;

try {
    require dirname(__DIR__) . '/config/bootstrap.php';

    if ($_SERVER['APP_DEBUG'] === true) {
        error_reporting(E_ALL);
    }

    $request = Request::createFromGlobals();

    // Создаем роутер
    $router = new Router(
        new ClosureLoader(),
        require dirname(__DIR__) . '/config/routes.php',
        ['cache_dir' => dirname(__DIR__) . '/var/cache', 'debug' => $_SERVER['APP_DEBUG'] === true],
        (new RequestContext())->fromRequest($request)
    );

    // Определяем текуший роут
    $routeParams = $router->match($request->getRequestUri());

    // Создаем котроллер

    /** @var ControllerInterface|ContainerAwareInterface $controller */
    $controller = $serviceContainer->get($routeParams['_controller']);
    $controller->setContainer($serviceContainer);

    // Обрабатываем запрос, возвращаем ответ
    $controller->process($request)->send();

} catch (Throwable $ex) {
    // Обработка непредвиденной ошибки

    if ($_SERVER['APP_DEBUG'] === true) {
        /** @noinspection ForgottenDebugOutputInspection */
        print_r($ex->getMessage());

        /** @noinspection ForgottenDebugOutputInspection */
        print_r($ex->getTraceAsString());
        exit();
    }

    //TODO::add logging

    /** @var ApiErrorsDescriptor $apiErrorsDescriptor */
    $apiErrorsDescriptor = $serviceContainer->get(ApiErrorsDescriptor::class);
    $apiErrorDescription = $apiErrorsDescriptor->getErrorDescriptionByCode('unexpected_error');

    /** @var ApiErrorController $errorController */
    $errorController = $serviceContainer->get(ApiErrorController::class);
    $errorController->errorResponse([], [$apiErrorDescription->getDescription()], $apiErrorDescription->getCode())->send();
}