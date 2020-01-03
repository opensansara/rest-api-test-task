<?php
namespace App\Model\Product\UseCase\GenerateTestProducts;

class GenerateTestProductsCommand
{
    /**
     * @var int
     */
    private $numProducts;

    /**
     * Создать товары в транзакции, т.е. либо все, либо ничего
     * @var bool
     */
    private $transactional;

    /**
     * GenerateTestProductsCommand constructor.
     * @param int $numProducts
     * @param bool $transactional
     */
    public function __construct(int $numProducts, bool $transactional)
    {
        $this->numProducts = $numProducts;
        $this->transactional = $transactional;
    }

    /**
     * @return int
     */
    public function getNumProducts(): int
    {
        return $this->numProducts;
    }

    /**
     * @return bool
     */
    public function isTransactional(): bool
    {
        return $this->transactional;
    }
}