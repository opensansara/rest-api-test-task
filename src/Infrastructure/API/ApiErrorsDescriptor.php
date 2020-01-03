<?php
namespace App\Infrastructure\API;

class ApiErrorsDescriptor
{
    private $errors = [
        'unexpected_error' => [
            'text' => 'При выполнении запроса произошла ошибка',
            'code' => 500
        ]
    ];

    /**
     * @param string $code
     * @return array|mixed
     */
    public function getErrorDescriptionByCode(string $code) : ApiErrorDescription
    {
        if (!isset($this->errors[$code])) {
            throw new \OutOfBoundsException('Неизвестный код ошибка');
        }

        $errorDescription = $this->errors[$code];

        return new ApiErrorDescription($errorDescription['code'], $errorDescription['text']);
    }
}