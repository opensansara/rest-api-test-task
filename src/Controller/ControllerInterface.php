<?php
/**
 * Интерфейс контроллера
 * Задача контроллера - обработать запрос и вернуть ответ
 * Предполагается, что все параметры контроллер получит через конструктор
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ControllerInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function process(Request $request) : Response;
}