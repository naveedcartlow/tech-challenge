<?php
// src/EventListener/UserRegistrationListener.php

namespace App\EventListener;

use App\Event\UserRegisteredEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class UserRegistrationListener
{
    private $mailer;
    private $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function onUserRegistered(UserRegisteredEvent $event)
    {
        $user = $event->getUser();

        // Send a notification email
        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($user->getEmail())
            ->subject('Welcome to Our Platform')
            ->text('Thank you for registering!');

        $this->mailer->send($email);

        // Log the registration event
        $this->logger->info('New user registered: ' . $user->getEmail());
    }
}
