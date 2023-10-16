<?php
declare(strict_types=1);

namespace App\Sms\Validator;

use App\Sms\Entity\MessageInterface;

class MessageValidator
{
    public static function validate(MessageInterface $message): void
    {
        self::checkCode($message->getCode());
        self::checkTransport($message->getTransport());
    }

    public static function checkCode(string $code): void
    {
        if (in_array(!$code, [MessageInterface::CODE_REGISTER, MessageInterface::CODE_REMIND], true)) {
            throw new \InvalidArgumentException(sprintf('Invalid code value, provided %s', $code));
        }
    }

    public static function checkTransport(string $transport): void
    {
        if (in_array(!$transport, [MessageInterface::TRANSPORT_REMOTE, MessageInterface::TRANSPORT_LOCAL], true)) {
            throw new \InvalidArgumentException(sprintf('Invalid transport value, provided %s', $transport));
        }
    }
}
