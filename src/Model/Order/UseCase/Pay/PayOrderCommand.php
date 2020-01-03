<?php
namespace App\Model\Order\UseCase\Pay;

class PayOrderCommand
{
    /**
     * @var int
     */
    private $orderId;

    /**
     * @var int
     */
    private $price;

    /**
     * PayOrderCommand constructor.
     * @param int $orderId
     * @param int $price
     */
    public function __construct(int $orderId, int $price)
    {
        $this->orderId = $orderId;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}