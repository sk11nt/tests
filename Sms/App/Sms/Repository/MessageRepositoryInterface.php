<?php
declare(strict_types=1);

namespace App\Sms\Repository;

use App\Sms\Entity\MessageInterface;

interface MessageRepositoryInterface
{
    public function getMessageByCode(string $code): MessageInterface;
}
