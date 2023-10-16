<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistance\Entity;

use App\Sms\Entity\MessageInterface;
use App\Sms\Validator\MessageValidator;

class Message implements MessageInterface
{
    private int $id;
    private string $code;
    private string $message;
    private string $transport;


    public function __construct(string $code, string $message, string $transport)
    {
        $this->code = $code;
        $this->message = $message;
        $this->transport = $transport;

        MessageValidator::validate($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTransport(): string
    {
        return $this->transport;
    }
}
