<?php
declare(strict_types=1);

namespace App\Sms\Entity;

interface MessageInterface
{
    public const CODE_REMIND = 'remind';
    public const CODE_REGISTER = 'register';
    public const TRANSPORT_LOCAL = 'local';
    public const TRANSPORT_REMOTE = 'remote';

    public function getCode(): string;
    public function getMessage(): string;
    public function getTransport(): string;
}
