<?php
namespace App\Controller\Api\Order;

use App\Controller\Api\ApiBaseController;
use App\Model\Order\Exception\OrderPayException;
use App\Model\Order\UseCase\Pay\PayOrderCommand;
use App\Model\Order\UseCase\Pay\PayOrderCommandHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PayOrderController extends ApiBaseController
{
    /**
     * @var PayOrderCommandHandler
     */
    private $payOrderCommandHandler;

    /**
     * @param PayOrderCommandHandler $payOrderCommandHandler
     */
    public function __construct(PayOrderCommandHandler $payOrderCommandHandler)
    {
        $this->payOrderCommandHandler = $payOrderCommandHandler;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Throwable
     */
    public function process(Request $request): Response
    {
        $command = new PayOrderCommand(
            $request->get('order_id'),
            $request->get('price')
        );

        try {
            $this->payOrderCommandHandler->handle($command);
        } catch (OrderPayException $ex) {
            return $this->errorResponse([], [$ex->getMessage()]);
        }

        return $this->successResponse(['payed' => 'ok']);
    }
}