<?php
namespace App\Model\Order\UseCase\Create;

use App\Model\Order\Entity\Order;
use App\Model\Order\Repository\OrderRepository;

class CreateOrderCommandHandler
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param CreateOrderCommand $command
     * @return int
     * @throws \Throwable
     */
    public function handle(CreateOrderCommand $command) : int
    {
        $order = new Order(
            $command->getId(),
            $command->getUserId(),
            $command->getStatus(),
            $command->getProductIds(),
            $command->getDateCreate(),
            $command->getPrice()
        );

        return $this->orderRepository->save($order);
    }
}