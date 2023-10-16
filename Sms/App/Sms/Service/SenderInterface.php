<?php
declare(strict_types=1);

namespace App\Sms\Service;

use App\Security\Entity\UserInterface;

interface SenderInterface
{
    public function sendPasswordReminder(UserInterface $recipient, string $password): void;
    public function sendRegistrationMessage(UserInterface $recipient): void;
}
