<?php
namespace App\Model\Product\Repository;

use App\Model\Product\Entity\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class ProductRepository
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
     * @param Product $product
     * @return int
     * @throws DBALException
     */
    public function saveProduct(Product $product) : int
    {
        $sql = $product->getId() === 0
            ? 'INSERT INTO products SET id=:id, name=:name, price=:price'
            : 'UPDATE products SET id=:id, name=:name, price=:price';

        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue('id', $product->getId());
        $stmt->bindValue('name', $product->getName());
        $stmt->bindValue('price', $product->getPrice());

        $stmt->execute();

        return $this->connection->lastInsertId();
    }

    /**
     * @return Product[]
     * @throws DBALException
     */
    public function findAll()
    {
        $products = [];

        $iterator = $this->connection->query('SELECT * FROM products');
        while ($productData = $iterator->fetch()) {
            $products[] = new Product($productData['id'], $productData['name'], $productData['price']);
        }

        return $products;
    }
}