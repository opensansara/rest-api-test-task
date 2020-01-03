<?php
namespace App\Model\Order\Repository;

use App\Model\Order\Entity\Order;
use Doctrine\DBAL\Connection;

class OrderRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Order $order
     * @return int номер созданного заказа
     * @throws \Exception
     * @throws \Throwable
     */
    public function save(Order $order) : int
    {
        if ($order->getId() === 0) {
            return $this->createNewOrder($order);
        }

        throw new \Exception('Not implemented order update');
    }

    /**
     * @param Order $order
     * @return mixed
     * @throws \Throwable
     */
    private function createNewOrder(Order $order)
    {
        $orderId = $this->connection->transactional(function ($connection) use ($order) {
            $sql ='INSERT INTO orders SET id=0, user_id=:user_id, status_id=:status_id, date_create=:date_create';

            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue('user_id', $order->getUserId());
            $stmt->bindValue('status_id', $order->getStatus()->getValue());
            $stmt->bindValue('date_create', $order->getDateCreate()->format('Y-m-d H:i:s'));

            $stmt->execute();

            $orderId = $connection->lastInsertId();

            foreach ($order->getProductIds() as $productId) {
                $sql = 'INSERT INTO order_products SET order_id=:order_id, product_id=:product_id';
                $stmt = $this->connection->prepare($sql);

                $stmt->bindValue('order_id', $orderId);
                $stmt->bindValue('product_id', $productId);

                $stmt->execute();
            }

            return $orderId;
        });

        return $orderId;
    }
}