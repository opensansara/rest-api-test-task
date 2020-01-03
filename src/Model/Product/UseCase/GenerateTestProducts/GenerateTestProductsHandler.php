<?php
namespace App\Model\Product\UseCase\GenerateTestProducts;

use App\Model\Product\Entity\Product;
use Doctrine\DBAL\Connection;

class GenerateTestProductsHandler
{
    public function handle(GenerateTestProductsCommand $command)
    {
        for ($i = 0; $i < $command->getNumProducts(); $i++) {
            $product = new Product(0, 'Product #' . ($i + 1), 1000 + $i);
        }
    }
}