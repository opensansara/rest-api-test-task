<?php
namespace App\Model\Order\Repository;

use App\Model\Order\Entity\Order;
use App\Model\Order\OrderStatus;
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

        $this->updateOrder($order);
        return $order->getId();
    }

    /**
     * @param int $id
     * @return Order
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findOrderWithoutProducts(int $id) : Order
    {
        $orderData = $this->connection->query('SELECT * FROM orders WHERE id=' . $id)->fetch();
        if (!$orderData) {
            throw new \DomainException('Заказ не найден');
        }

        return new Order(
            $orderData['id'],
            $orderData['user_id'],
            OrderStatus::make($orderData['status_id']),
            [],
            new \DateTimeImmutable($orderData['date_create']),
            $orderData['price']
        );
    }

    /**
     * @param Order $order
     * @return mixed
     * @throws \Throwable
     */
    private function createNewOrder(Order $order)
    {
        $orderId = $this->connection->transactional(function ($connection) use ($order) {
            $sql ='INSERT INTO orders SET id=0, user_id=:user_id, status_id=:status_id, date_create=:date_create, price=:price';

            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue('user_id', $order->getUserId());
            $stmt->bindValue('status_id', $order->getStatus()->getValue());
            $stmt->bindValue('date_create', $order->getDateCreate()->format('Y-m-d H:i:s'));
            $stmt->bindValue('price', $order->getPrice());

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

    /**
     * @param Order $order
     * @throws \Doctrine\DBAL\DBALException
     */
    private function updateOrder(Order $order)
    {
        //TODO::implement full update
        $sql = 'UPDATE orders SET status_id=:status_id WHERE id=:order_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('status_id', $order->getStatus()->getValue());
        $stmt->bindValue('order_id', $order->getId());
        $stmt->execute();
    }
}