<?php
declare(strict_types=1);

namespace App\Sms\Builder;

use App\Sms\DTO\Sms;
use App\Sms\Entity\MessageInterface;

class SmsProducer
{
    public function createSms(MessageInterface $message, array $context): Sms
    {
        return new Sms($this->buildRecipientString($context), $this->buildSmsBody($message, $context));
    }

    private function buildRecipientString(array $context): string
    {
        return sprintf('%s <%s>', $context['name'], $context['phoneNumber']);
    }

    private function buildSmsBody(MessageInterface $message, array $context): string
    {
        return str_ireplace(
            ['{name}', '{password}'],
            [$context['name'], $context['password']],
            $message->getMessage()
        );
    }
}
