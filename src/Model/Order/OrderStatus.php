<?php
namespace App\Model\Order;

use Spatie\Enum\Enum;

class OrderStatus extends Enum
{
    public static function new(): OrderStatus
    {
        return new class() extends OrderStatus {
            public function getValue(): string
            {
                return 1;
            }
        };
    }

    public static function paid(): OrderStatus
    {
        return new class() extends OrderStatus {
            public function getValue(): string
            {
                return 2;
            }
        };
    }
}