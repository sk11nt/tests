<?php
declare(strict_types=1);

namespace App\Controller;

use App\Security\Provider\SecurityDataProviderInterface;
use App\Sms\Service\SenderInterface;
use http\Client\Response;

class Auth
{
    private SecurityDataProviderInterface $userProvider;
    private SenderInterface $sender;


    public function __construct(SecurityDataProviderInterface $userProvider, SenderInterface $sender)
    {
        $this->userProvider = $userProvider;
        $this->sender = $sender;
    }

    public function remindAction(): Response
    {
        // Some logic goes before....
        try {
            $this->sender->sendPasswordReminder(
                $this->userProvider->getUser(),
                $this->userProvider->generateTemporaryPassword()
            );
        } catch (\Exception $e) {
            // Show error message
        }
        // Some logic goes after....
    }

    public function registerAction(): Response
    {
        // Some logic goes before....
        try {
            $this->sender->sendRegistrationMessage($this->userProvider->getUser());
        } catch (\Exception $e) {
            // Show error message
        }
        // Some logic goes after....
    }
}
