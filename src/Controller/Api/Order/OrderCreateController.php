<?php
namespace App\Controller\Api\Order;

use App\Controller\Api\ApiBaseController;
use App\Model\Order\OrderStatus;
use App\Model\Order\UseCase\Create\CreateOrderCommand;
use App\Model\Order\UseCase\Create\CreateOrderCommandHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderCreateController extends ApiBaseController
{
    /**
     * @var CreateOrderCommandHandler
     */
    private $createOrderCommandHandler;

    public function __construct(CreateOrderCommandHandler $createOrderCommandHandler)
    {
        $this->createOrderCommandHandler = $createOrderCommandHandler;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function process(Request $request): Response
    {
        $command = new CreateOrderCommand(
            $id = 0,
            $userId = $this->getContainer()->get('user')->getId(),
            $status = OrderStatus::new(),
            $productIds = $request->get('products'),
            $dateCreate = new \DateTimeImmutable()
        );

        $orderId = $this->createOrderCommandHandler->handle($command);

        return $this->successResponse(['order_id' => $orderId]);
    }
}