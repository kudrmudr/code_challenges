<?php

namespace Auto1;

class User
{
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;

    public function setFirstName(string $value): self
    {
        $this->firstName = $value;

        return $this;
    }

    public function setLastName(string $value): self
    {
        $this->lastName = $value;

        return $this;
    }

    public function setEmail(string $value): self
    {
        $this->email = $value;

        return $this;
    }

    public function __toString(): string
    {
        return trim(
            ($this->firstName ? $this->firstName . ' ' : '')
            . ($this->lastName ? $this->lastName . ' ' : '')
            . ($this->email ? '<' . $this->email . '>' : '')
        );
    }
}

$user = new User();

$user->setFirstName('John')
    ->setLastName('Doe')
    ->setEmail('john.doe@example.com');

echo $user;