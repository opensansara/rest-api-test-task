<?php
namespace App\Controller\Api\Product;

use App\Controller\Api\ApiBaseController;
use App\Model\Product\UseCase\GenerateTestProducts\GenerateTestProductsCommand;
use App\Model\Product\UseCase\GenerateTestProducts\GenerateTestProductsHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GenerateTestProductsController extends ApiBaseController
{
    /**
     * @var GenerateTestProductsHandler
     */
    private $generateTestProductsHandler;

    /**
     * GenerateTestProductsController constructor.
     * @param GenerateTestProductsHandler $generateTestProductsHandler
     */
    public function __construct(GenerateTestProductsHandler $generateTestProductsHandler)
    {
        $this->generateTestProductsHandler = $generateTestProductsHandler;
    }

    /**
     * @inheritDoc
     * @throws \Throwable
     */
    public function process(Request $request): Response
    {
        $numProductsToGenerate = 20;
        $command = new GenerateTestProductsCommand($numProductsToGenerate, true);
        $this->generateTestProductsHandler->handle($command);

        return $this->successResponse(['num_generated' => $numProductsToGenerate]);
    }
}