<?php
declare(strict_types=1);

namespace App\Infrastructure\MessageTransport\Local;

use App\Sms\DTO\Sms;
use App\Sms\Transport\TransportInterface;

class SmsTransportUkraine implements TransportInterface
{
    public function sendMessage(Sms $sms): void
    {}
}
