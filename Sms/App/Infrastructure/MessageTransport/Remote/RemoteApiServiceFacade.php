<?php
declare(strict_types=1);

namespace App\Infrastructure\MessageTransport\Remote;

use App\Sms\DTO\Sms;
use App\Sms\Transport\TransportInterface;

class RemoteApiServiceFacade implements TransportInterface
{
    public function sendMessage(Sms $sms): void
    {
        //Here goes remote service API integration via SDK code injection
    }
}
