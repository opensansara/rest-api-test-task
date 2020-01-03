<?php
/**
 * Просетейший демонстрационный http клиент
 */
namespace App\Infrastructure\Http;

class HttpClient
{
    /**
     * @param string $url
     * @return mixed
     */
    public function getResponseCode(string $url)
    {
        @file_get_contents($url);
        return $http_response_header;
    }
}