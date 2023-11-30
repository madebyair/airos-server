<?php

namespace Server\Session;

class Session
{
    private string $uuid;
    private string $modelId;

    private string $firstName;
    private string $lastName;

    private string $email;

    private string $password; // Of course encrypted

    public function __construct(string $uuid, string $modelId, string $firstName, string $lastName, string $email, string $password) {
        $this->uuid = $uuid;
        $this->modelId = $modelId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getModelId(): string
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}