<?php
/**
 * Сервис-локатор для котроллеров
 */

namespace App\Infrastructure\ServiceLocator;

use App\Controller\ControllerInterface;
use Zend\ServiceManager\AbstractPluginManager;

class ControllerServiceLocator  extends AbstractPluginManager
{
    protected $instanceOf = ControllerInterface::class;
}