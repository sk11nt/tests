<?php
declare(strict_types=1);

namespace App\Sms\Service;

use App\Security\Entity\UserInterface;
use App\Sms\Builder\SmsProducer;
use App\Sms\Entity\MessageInterface;
use App\Sms\Provider\TransportProvider;
use App\Sms\Repository\MessageRepositoryInterface;

class Sender implements SenderInterface
{
    private MessageRepositoryInterface $messageRepository;
    private TransportProvider $transportProvider;
    private SmsProducer $smsProducer;

    public function sendPasswordReminder(UserInterface $recipient, string $password): void
    {
        $this->sendMessage(
            $this->messageRepository->getMessageByCode(MessageInterface::CODE_REMIND),
            $recipient,
            ['name' => $recipient->getName(), 'phoneNumber' => $recipient->getPhoneNumber(), 'password' => $password]
        );
    }

    public function sendRegistrationMessage(UserInterface $recipient): void
    {
        $this->sendMessage(
            $this->messageRepository->getMessageByCode(MessageInterface::CODE_REGISTER),
            $recipient,
            ['name' => $recipient->getName(), 'phoneNumber' => $recipient->getPhoneNumber()]
        );
    }

    protected function sendMessage(MessageInterface $message, UserInterface $recipient, array $context): void
    {
        $transport = $this->transportProvider->getTransport($message, $recipient);
        $sms = $this->smsProducer->createSms($message, $context);

        $transport->sendMessage($sms);
    }
}
