<?php
/**
 * Интерфейс сущности, которая может храниться в БД
 * Сделано без лишних усложнений, сущность сама должна уметь формировать запросы к БД
 */

namespace App\Infrastructure;

interface PersistableEntityInterface
{
    /**
     * @return void
     */
    public function save();

    /**
     * @return void
     */
    public function delete();
}