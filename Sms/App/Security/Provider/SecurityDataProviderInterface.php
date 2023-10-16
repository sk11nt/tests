<?php
declare(strict_types=1);

namespace App\Security\Provider;

use App\Security\Entity\UserInterface;

interface SecurityDataProviderInterface
{
    public function getUser(): UserInterface;
    public function generateTemporaryPassword(): string;
}
