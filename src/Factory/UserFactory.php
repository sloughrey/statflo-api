<?php
namespace App\Factory;

use App\Entity\User;
use App\Interfaces\IUserFactory;

class UserFactory implements IUserFactory
{
    public static function createUser()
    {
        $user = new User();
        return $user;
    }
}
