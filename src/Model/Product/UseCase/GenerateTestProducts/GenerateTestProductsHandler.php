<?php
/**
 * Создает тестовый набор товаров
 */
namespace App\Model\Product\UseCase\GenerateTestProducts;

use App\Model\Product\Entity\Product;
use App\Model\Product\Repository\ProductRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class GenerateTestProductsHandler
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param ProductRepository $productRepository
     * @param Connection $connection
     */
    public function __construct(ProductRepository $productRepository, Connection $connection)
    {
        $this->productRepository = $productRepository;
        $this->connection = $connection;
    }

    /**
     * @param GenerateTestProductsCommand $command
     * @throws \Throwable
     */
    public function handle(GenerateTestProductsCommand $command)
    {
        if ($command->isTransactional()) {
            $this->connection->transactional(function () use ($command) {
                $this->generateTestProducts($command);
            });
        } else {
            $this->generateTestProducts($command);
        }
    }

    /**
     * @param GenerateTestProductsCommand $command
     * @throws DBALException
     */
    private function generateTestProducts(GenerateTestProductsCommand $command)
    {
        for ($i = 0; $i < $command->getNumProducts(); $i++) {
            $product = new Product(0, 'Product #' . ($i + 1), 1001 + $i);
            $this->productRepository->saveProduct($product);
        }
    }
}