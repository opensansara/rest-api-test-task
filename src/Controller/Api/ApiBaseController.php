<?php
/**
 * Базовый контроллер для методов АПИ
 * И в случае успеха и в случае ошибки возвращаем HTTP код 200
 * Для индикации ошибки используем внутренние коды, передаваемые в теле ответа
 */
namespace App\Controller\Api;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiBaseController extends AbstractController
{
    /**
     * @param array $responseData
     * @param int $statusCode
     * @return Response
     */
    public function successResponse(array $responseData, int $statusCode = 0) : Response
    {
        $fullResponseData = [
            'data' => $responseData,
            'status' => 'success',
            'code' => $statusCode
        ];

        $response = new JsonResponse();
        $response->setContent(json_encode($fullResponseData));

        return $response;
    }

    /**
     * @param array $responseData
     * @param array $errorMessages
     * @param int $statusCode
     * @return Response
     */
    public function errorResponse(array $responseData, array $errorMessages = [], int $statusCode = 0) : Response
    {
        $fullResponseData = [
            'data' => $responseData,
            'status' => 'error',
            'error_messages' => $errorMessages,
            'code' => $statusCode
        ];

        $response = new JsonResponse();
        $response->setContent(json_encode($fullResponseData));

        return $response;
    }
}