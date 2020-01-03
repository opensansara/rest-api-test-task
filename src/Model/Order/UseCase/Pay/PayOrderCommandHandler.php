<?php
namespace App\Model\Order\UseCase\Pay;

use App\Infrastructure\Http\HttpClient;
use App\Model\Order\Exception\OrderPayException;
use App\Model\Order\OrderStatus;
use App\Model\Order\Repository\OrderRepository;
use Doctrine\DBAL\DBALException;

class PayOrderCommandHandler
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @param OrderRepository $orderRepository
     * @param HttpClient $httpClient
     */
    public function __construct(OrderRepository $orderRepository, HttpClient $httpClient)
    {
        $this->orderRepository = $orderRepository;
        $this->httpClient = $httpClient;
    }

    /**
     * @param PayOrderCommand $command
     * @return bool
     * @throws DBALException
     * @throws OrderPayException
     * @throws \Throwable
     */
    public function handle(PayOrderCommand $command) : bool
    {
        $order = $this->orderRepository->findOrderWithoutProducts($command->getOrderId());

        if ($order->getPrice() !== $command->getPrice()) {
            throw new OrderPayException('Переданная стоимость не равна стоимости заказа');
        }

        if (!$order->getStatus()->isEqual(OrderStatus::new())) {
            throw new OrderPayException('Оплатить можно только заказ в статусе "Новый"');
        }

        $httpResponseCode = $this->httpClient->getResponseCode('https://ya.ru');
        if (strpos($httpResponseCode, '200') === false) {
            throw new OrderPayException('Оплата невозможна из-за недоступности внешнего АПИ');
        }

        $order->pay();

        $this->orderRepository->save($order);
    }
}