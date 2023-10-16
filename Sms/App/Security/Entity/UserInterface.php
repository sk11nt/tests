<?php
declare(strict_types=1);

namespace App\Security\Entity;

interface UserInterface
{
    public function getName(): string;
    public function getCountry(): string;
    public function getPhoneNumber(): string;
}
