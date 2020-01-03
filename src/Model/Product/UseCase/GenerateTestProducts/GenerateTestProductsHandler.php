<?php
namespace App\Model\Product\UseCase\GenerateTestProducts;

class GenerateTestProductsHandler
{
    public function handle(GenerateTestProductsCommand $command)
    {
        for ($i = 0; $i < $command->getNumProducts(); $i++) {
            //TODO::create product
        }
    }
}