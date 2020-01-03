<?php
namespace App\Model\Order\UseCase\Create;

use App\Model\Order\OrderStatus;

class CreateOrderCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var OrderStatus
     */
    private $status;

    /**
     * //TODO::переделать на массив объектов Product
     * @var int[]
     */
    private $productIds;

    /**
     * @var \DateTimeImmutable
     */
    private $dateCreate;

    /**
     * Order constructor.
     * @param int $id
     * @param int $userId
     * @param OrderStatus $status
     * @param int[] $productIds
     * @param \DateTimeImmutable $dateCreate
     */
    public function __construct(int $id, int $userId, OrderStatus $status, array $productIds, \DateTimeImmutable $dateCreate)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->productIds = $productIds;
        $this->id = $id;
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    /**
     * @return int[]
     */
    public function getProductIds(): array
    {
        return $this->productIds;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateCreate(): \DateTimeImmutable
    {
        return $this->dateCreate;
    }
}