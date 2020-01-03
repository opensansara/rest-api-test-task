<?php
namespace App\Infrastructure\API;

class ApiErrorDescription
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * ApiError constructor.
     * @param int $code
     * @param string $description
     */
    public function __construct(int $code, string $description)
    {
        $this->code = $code;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}