<?php
// src/Event/UserRegisteredEvent.php

namespace App\Event;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class UserRegisteredEvent extends Event
{
    public const NAME = 'user.create';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
