<?php
namespace App\Infrastructure;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $login;

    /**
     * User constructor.
     * @param int $id
     * @param string $login
     */
    public function __construct(int $id, string $login)
    {
        $this->id = $id;
        $this->login = $login;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }
}