<?php
declare(strict_types=1);

namespace App\Sms\Provider;

use App\Infrastructure\MessageTransport\Local\SmsTransportAsia;
use App\Infrastructure\MessageTransport\Local\SmsTransportEu;
use App\Infrastructure\MessageTransport\Local\SmsTransportUkraine;
use App\Infrastructure\MessageTransport\Local\SmsTransportUsCa;
use App\Infrastructure\MessageTransport\Remote\RemoteApiServiceFacade;
use App\Security\Entity\UserInterface;
use App\Sms\Entity\MessageInterface;
use App\Sms\Exception\TransportNotFoundException;
use App\Sms\Transport\TransportInterface;

class TransportProvider
{
    private RemoteApiServiceFacade $remoteApiServiceFacade;
    private SmsTransportUkraine $smsTransportUkraine;
    private SmsTransportAsia $smsTransportAsia;
    private SmsTransportEu $smsTransportEu;
    private SmsTransportUsCa $smsTransportUsCa;

    /**
     * @throws TransportNotFoundException
     */
    public function getTransport(MessageInterface $message, UserInterface $user): TransportInterface
    {
        if (MessageInterface::TRANSPORT_REMOTE === $message->getTransport()) {
            return $this->remoteApiServiceFacade;
        }

        return $this->chooseLocalTransport($user);
    }

    /**
     * @throws TransportNotFoundException
     */
    protected function chooseLocalTransport(UserInterface $user): TransportInterface
    {
        switch ($user->getCountry()) {
            case 'UA':
                $transport = $this->smsTransportUkraine;
                break;
            case 'US':
            case 'CA':
                $transport = $this->smsTransportUsCa;
                break;
            case 'PL':
            case 'CZ':
            case 'DK':
            case 'DE':
                $transport = $this->smsTransportEu;
                break;
            case 'CH':
            case 'TW':
                $transport = $this->smsTransportAsia;
                break;
            default:
                throw new TransportNotFoundException();
        }

        return $transport;
    }
}
