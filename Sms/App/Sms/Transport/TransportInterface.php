<?php
declare(strict_types=1);

namespace App\Sms\Transport;

use App\Sms\DTO\Sms;

interface TransportInterface
{
    public function sendMessage(Sms $sms): void;
}
