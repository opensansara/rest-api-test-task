<?php
namespace App\Model\Product\UseCase\GenerateTestProducts;

class GenerateTestProductsCommand
{
    /**
     * @var int
     */
    private $numProducts;

    /**
     * GenerateTestProductsCommand constructor.
     * @param int $numProducts
     */
    public function __construct(int $numProducts)
    {
        $this->numProducts = $numProducts;
    }

    /**
     * @return int
     */
    public function getNumProducts(): int
    {
        return $this->numProducts;
    }
}